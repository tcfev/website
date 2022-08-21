function changeURL() {
    let str=window.location.href;
    let location = str;
    langs.forEach(lang => {
        location = location.replace('/'+lang+'/', '/'+this.options[this.selectedIndex].value+'/');
    })
    // if (location[location.length - 4] == '/') {
    //     let check = location.substring(location.length - 3, location.length - 1);
    //     if (langs.includes(check)) {
    //         location = location.substring(0, location.length - 3) + '/' + this.options[this.selectedIndex].value;
    //     }
    // }

    window.location = location;
}

function login(obj){
    var page = root + 'pg/cal/signin.php';
    var f = new FormData(obj);
    f.append('f', 'login');

    var request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.res == 1) {
                fastMsg(data.msg, function(){window.location = root + 'panel/projects';});
            } else if (data.res == 0) {
                fastMsg(data.msg);
            }
        }
    };
}

function logout(obj){
    var page = root + 'pg/cal/signin.php';
    var f = new FormData();
    f.append('f', 'logout');

    var request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            window.location.reload();
        }
    };
}

function changeLang() {
    let l = this.options[this.selectedIndex].value;
    var page = root + 'pg/cal/settings.php';
    var f = new FormData();
    f.append('f', 'changeLang');
    f.append('l', l);

    var request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            window.location.reload();
        }
    };
}

function slo() {
    let elm = document.getElementById('fly-loading');
    elm.classList.add('show');
    setTimeout(() => {
        elm.classList.add('ready');
    }, 100);
}

function elo() {
    let elm = document.getElementById('fly-loading');
    elm.classList.remove('ready');
    setTimeout(() => {
        elm.classList.remove('show');
    }, 300);
}

function minimizeProject(obj) {
    let id = obj.getAttribute('kc-id');
    let indx = obj.getAttribute('kc-indx');
    let doc = document.getElementById(id).querySelector('.f-holder-1');
    if (doc.classList.contains('minimized')) {
        doc.classList.remove('minimized');
        projectClass[indx] = '';
    } else {
        doc.classList.add('minimized');
        projectClass[indx] = 'minimized ';
    }
}



// ***************** PROJECTS *******************

function loadProjects(fn) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'loadProjects');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function prepareProjects(data) {
    for (let i = 0; i < data.length; i++) {
        projectClass.push('minimized');
    }
    // projectClass[0] = '';
    setProjects(data);
}

function setProjects(data) {
    data.forEach((el, ix) => {
        el.class = projectClass[ix];
    })
    innerDom('projects', data, 'pjs', null, false, null);
}

function addProject(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'addProject');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, true, '', '', 'timer');
        }
    };
}

function loadSingleProject(fn, id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'loadSingleProject');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function projectActive(obj) {
    let act = 0;
    if (obj.checked) act = 1;
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'projectActive');
    f.append('act', act);
    f.append('id', obj.getAttribute('kc-id'));

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, null, null, true, '', '', 'timer');
        }
    };
}

function projectTitleDialog(data) {
    innerDom('project-title-dialog-holder', data, 'ptd');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-title-dialog',
        type:'steady',
        cb: fn
    })
}

function startProjectTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProject(projectTitleDialog, id);
}

function projectTitle(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function startProjectExp(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProject(projectExpDialog, id);
}

function projectExpDialog(data) {
    innerDom('project-exp-dialog-holder', data, 'ped');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-exp-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-exp-dialog',
        type:'steady',
        cb: fn
    })
}

function projectExp(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectExp');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function projectDescrDialog(data) {
    innerDom('project-descr-dialog-holder', data, 'pdd');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-descr-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
        let eds = document.getElementById('project-descr-dialog-popup').querySelectorAll('.editor');

        for (let i = 0; i < eds.length; i++) {

            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
              
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],     // superscript/subscript
              
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                ['image', 'video']
              ];
            var options = {
                modules: {
                  toolbar: toolbarOptions
                },
                readOnly: false,
                theme: 'snow'
            };
            let ed = eds[i];
            let editor = new Quill(ed, options);

            editor.on('text-change', function(delta, oldDelta, source) {
                let cont = ed.querySelector('p').parentElement.innerHTML;
                document.getElementById('project-descr-dialog-popup').querySelectorAll('input[name="d"]')[i].value = cont;
            });
        }
        
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-descr-dialog',
        type:'steady',
        cb: fn,
        size:'lg'
    })
}

function startProjectDescr(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProject(projectDescrDialog, id);
}

function projectDescr(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectDescr');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function deleteProjectDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteProject(id);}
    })
}

function deleteProject(id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'deleteProject');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadProjects(setProjects);
        }
    };
}







// ************ PROJECT GALLERY ***************

function addProjectImage(obj) {
    slo();
    let id = obj.getAttribute('kc-id');
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'addProjectImage');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);elo();}, null, true, '', '', 'timer');
        }
    };
}

function startProjectImage(obj) {
    let id = obj.getAttribute('kc-id');
    document.getElementById('project-image-dialog').querySelectorAll('input[type="hidden"')[0].value = id;
    let pm = new popup({
        id:'pmsg',
        target:'project-image-dialog',
        type:'steady'
    })
}

function submitProjectImage(obj) {
    slo();
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectImage');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            elo();
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function loadSingleProjectImage(fn, id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'loadSingleProjectImage');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startProjectImageTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProjectImage(projectImageTitleDialog, id);
}

function projectImageTitleDialog(data) {
    innerDom('project-image-title-dialog-holder', data, 'pgtd');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-image-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-image-title-dialog',
        type:'steady',
        cb: fn
    })
}

function projectImageTitle(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectImageTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function deleteProjectImageDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteProjectImage(id);}
    })
}

function deleteProjectImage(id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'deleteProjectImage');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadProjects(setProjects);
        }
    };
}





// ****************** PROJECT VIDEO *******************

function addProjectVideo(obj) {
    let id = obj.getAttribute('kc-id');
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'addProjectVideo');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, true, '', '', 'timer');
        }
    };
}

function startProjectVideo(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProjectVideo(projectVideoDialog, id);
}

function projectVideoDialog(data) {
    innerDom('project-video-dialog-holder', data, 'pvd');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-video-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-video-dialog',
        type:'steady',
        cb: fn
    })
}

function projectVideo(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectVideo');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function loadSingleProjectVideo(fn, id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'loadSingleProjectVideo');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startProjectVideoTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleProjectVideo(projectVideoTitleDialog, id);
}

function projectVideoTitleDialog(data) {
    innerDom('project-video-title-dialog-holder', data, 'pvtd');

    let fn = function() {
        kdsArray.push(DivSlider.create('project-video-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'project-video-title-dialog',
        type:'steady',
        cb: fn
    })
}

function projectVideoTitle(obj) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData(obj);
    f.append('f', 'projectVideoTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadProjects(setProjects);}, null, false, '', '', 'timer');
        }
    };
}

function deleteProjectVideoDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteProjectVideo(id);}
    })
}

function deleteProjectVideo(id) {
    let page = root + 'pg/cal/project.php';
    let f = new FormData();
    f.append('f', 'deleteProjectVideo');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadProjects(setProjects);
        }
    };
}




// *************** MEMBERS **************

function loadAboutUs(fn) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'loadAboutUs');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function loadAboutUss(fn) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'loadAboutUss');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setAboutUs(data) {
    innerDom('about-us', data, 'abu');
}

function startAboutUsDescr(obj) {
    loadAboutUss(aboutUsDescrDialog);
}

function aboutUsDescrDialog(data) {
    innerDom('about-us-descr-dialog-holder', data, 'aud');

    let fn = function() {
        kdsArray.push(DivSlider.create('about-us-descr-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
        let eds = document.getElementById('about-us-descr-dialog-popup').querySelectorAll('.editor');
        for (let i = 0; i < eds.length; i++) {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
              
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
              
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
              ];
            var options = {
                modules: {
                  toolbar: toolbarOptions
                },
                readOnly: false,
                theme: 'snow'
            };
            let ed = eds[i];
            let editor = new Quill(ed, options);

            editor.on('text-change', function(delta, oldDelta, source) {
                let cont = ed.querySelector('p').parentElement.innerHTML;
                document.getElementById('about-us-descr-dialog-popup').querySelectorAll('input[name="d"]')[i].value = cont;
            });
        }
    }
    let pm = new popup({
        id:'pmsg',
        target:'about-us-descr-dialog',
        type:'steady',
        cb: fn,
        size: 'lg'
    })
}

function aboutUsDescr(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'aboutUsDescr');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadAboutUs(setAboutUs);}, null, false, '', '', 'timer');
        }
    };
}

function addMember() {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'addMember');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, true, '', '', 'timer');
        }
    };
}

function loadMembers(fn) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'loadMembers');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data)
        }
    };
}

function setMembers(data) {
    innerDom('members', data, 'mem');
}

function startMemberAvatar(obj) {
    let id = obj.getAttribute('kc-id');
    document.getElementById('member-avatar-dialog').querySelectorAll('input[type="hidden"')[0].value = id;
    let pm = new popup({
        id:'pmsg',
        target:'member-avatar-dialog',
        type:'steady'
    })
}

function submitMemberAvatar(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberAvatar');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function memberActive(obj) {
    let act = 0;
    if (obj.checked) act = 1;
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'memberActive');
    f.append('act', act);
    f.append('id', obj.getAttribute('kc-id'));

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, null, null, true, '', '', 'timer');
        }
    };
}

function loadSingleMember(fn, id) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'loadSingleMember');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startMemberName(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleMember(memberNameDialog, id);
}

function memberNameDialog(data) {
    innerDom('member-name-dialog-holder', data, 'ivn');

    let fn = function() {
        kdsArray.push(DivSlider.create('member-name-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }

    let pm = new popup({
        id:'pmsg',
        target:'member-name-dialog',
        type:'steady',
        cb: fn
    })
}

function memberName(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberName');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function loadSingleMemberLink(fn, id) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'loadSingleMemberLink');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startMemberLink(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleMemberLink(memberLinkDialog, id);
}

function memberLinkDialog(data) {
    innerDom('member-link-dialog-holder', data, 'ild');

    
    let pm = new popup({
        id:'pmsg',
        target:'member-link-dialog',
        type:'steady'
    })
}

function memberLink(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberLink');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function startMemberPost(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleMember(memberPostDialog, id);
}

function memberPostDialog(data) {
    innerDom('member-post-dialog-holder', data, 'mpd');

    let fn = function() {
        kdsArray.push(DivSlider.create('member-post-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }

    let pm = new popup({
        id:'pmsg',
        target:'member-post-dialog',
        type:'steady',
        cb: fn
    })
}

function memberPost(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberPost');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function startMemberEmail(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleMemberLink(memberEmailDialog, id);
}

function memberEmailDialog(data) {
    innerDom('member-email-dialog-holder', data, 'med');

    
    let pm = new popup({
        id:'pmsg',
        target:'member-email-dialog',
        type:'steady'
    })
}

function memberEmail(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberEmail');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function startMemberInfo(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleMember(memberInfoDialog, id);
}

function memberInfoDialog(data) {
    innerDom('member-info-dialog-holder', data, 'mid');

    let fn = function() {
        kdsArray.push(DivSlider.create('member-info-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'member-info-dialog',
        type:'steady',
        cb: fn
    })
}

function memberInfo(obj) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData(obj);
    f.append('f', 'memberInfo');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMembers(setMembers);}, null, false, '', '', 'timer');
        }
    };
}

function deleteMemberDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteMember(id);}
    })
}

function deleteMember(id) {
    let page = root + 'pg/cal/member.php';
    let f = new FormData();
    f.append('f', 'deleteMember');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadMembers(setMembers);
        }
    };
}




// ************** LANDING **************

function loadAbout(fn) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData();
    f.append('f', 'loadAbout');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function loadAbouts(fn) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData();
    f.append('f', 'loadAbouts');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setAbout(data) {
    innerDom('about', data, 'abt');
}

function startAboutTitle(obj) {
    loadAbouts(aboutTitleDialog);
}

function aboutTitleDialog(data) {
    innerDom('about-title-dialog-holder', data, 'atd');

    let fn = function() {
        kdsArray.push(DivSlider.create('about-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'about-title-dialog',
        type:'steady',
        cb: fn
    })
}

function aboutTitle(obj) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData(obj);
    f.append('f', 'aboutTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadAbout(setAbout);}, null, false, '', '', 'timer');
        }
    };
}

function startAboutDescr(obj) {
    loadAbouts(aboutDescrDialog);
}

function aboutDescrDialog(data) {
    innerDom('about-descr-dialog-holder', data, 'add');

    let fn = function() {
        kdsArray.push(DivSlider.create('about-descr-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
        let eds = document.getElementById('about-descr-dialog-popup').querySelectorAll('.editor');
        for (let i = 0; i < eds.length; i++) {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
              
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
              
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
              ];
            var options = {
                modules: {
                  toolbar: toolbarOptions
                },
                readOnly: false,
                theme: 'snow'
            };
            let ed = eds[i];
            let editor = new Quill(ed, options);

            editor.on('text-change', function(delta, oldDelta, source) {
                let cont = ed.querySelector('p').parentElement.innerHTML;
                document.getElementById('about-descr-dialog-popup').querySelectorAll('input[name="d"]')[i].value = cont;
            });
        }
    }
    let pm = new popup({
        id:'pmsg',
        target:'about-descr-dialog',
        type:'steady',
        cb: fn,
        size: 'lg'
    })
}

function aboutDescr(obj) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData(obj);
    f.append('f', 'aboutDescr');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadAbout(setAbout);}, null, false, '', '', 'timer');
        }
    };
}

function loadMain(fn) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData();
    f.append('f', 'loadMain');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function loadMains(fn) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData();
    f.append('f', 'loadMains');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setMain(data) {
    innerDom('main', data, 'mnn');
}

function startMainTitle(obj) {
    loadMains(mainTitleDialog);
}

function mainTitleDialog(data) {
    innerDom('main-title-dialog-holder', data, 'mtd');

    let fn = function() {
        kdsArray.push(DivSlider.create('main-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'main-title-dialog',
        type:'steady',
        cb: fn
    })
}

function mainTitle(obj) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData(obj);
    f.append('f', 'mainTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMain(setMain);}, null, false, '', '', 'timer');
        }
    };
}

function startMainDescr(obj) {
    loadMains(mainDescrDialog);
}

function mainDescrDialog(data) {
    innerDom('main-descr-dialog-holder', data, 'mdd');

    let fn = function() {
        kdsArray.push(DivSlider.create('main-descr-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
        let eds = document.getElementById('main-descr-dialog-popup').querySelectorAll('.editor');
        for (let i = 0; i < eds.length; i++) {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
              
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{'direction': 'rtl'}, {'align': []}],
              
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
              ];
            var options = {
                modules: {
                  toolbar: toolbarOptions
                },
                readOnly: false,
                theme: 'snow'
            };
            let ed = eds[i];
            let editor = new Quill(ed, options);

            editor.on('text-change', function(delta, oldDelta, source) {
                let cont = ed.querySelector('p').parentElement.innerHTML;
                document.getElementById('main-descr-dialog-popup').querySelectorAll('input[name="d"]')[i].value = cont;
            });
        }
    }
    let pm = new popup({
        id:'pmsg',
        target:'main-descr-dialog',
        type:'steady',
        cb: fn,
        size: 'lg'
    })
}

function mainDescr(obj) {
    let page = root + 'pg/cal/landing.php';
    let f = new FormData(obj);
    f.append('f', 'mainDescr');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadMain(setMain);}, null, false, '', '', 'timer');
        }
    };
}




// ***************** SETTINGS ****************

function addLink() {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'addLink');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadLinks(setLinks);
        }
    };
}

function loadLinks(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadLinks');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function loadSingleLinkAddress(fn, id) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadSingleLinkAddress');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function loadSingleLink(fn, id) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadSingleLink');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setLinks(data) {
    innerDom('links', data, 'lnk');
}

function startFooterLinkAddress(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleLinkAddress(footerLinkAddress, id);
}

function footerLinkAddress(data) {
    innerDom('link-address-dialog-holder', data, 'ild');

    let pm = new popup({
        id:'pmsg',
        target:'link-address-dialog',
        type:'steady'
    })
}

function linkAddress(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'linkAddress');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadLinks(setLinks);}, null, false, '', '', 'timer');
        }
    };
}

function startFooterLinkTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleLink(footerLinkTitleDialog, id);
}

function footerLinkTitleDialog(data) {
    innerDom('link-title-dialog-holder', data, 'ivn');

    let fn = function() {
        kdsArray.push(DivSlider.create('link-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }

    let pm = new popup({
        id:'pmsg',
        target:'link-title-dialog',
        type:'steady',
        cb: fn
    })
}

function linkTitle(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'linkTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadLinks(setLinks);}, null, false, '', '', 'timer');
        }
    };
}

function deleteFooterLinkDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteFooterLink(id);}
    })
}

function deleteFooterLink(id) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'deleteFooterLink');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadLinks(setLinks);
        }
    };
}

function loadSingleSocial(fn, soc) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadSingleSocial');
    f.append('soc', soc);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startSocial(obj) {
    let soc = obj.getAttribute('kc-id');
    loadSingleSocial(socialDialog, soc);
}

function socialDialog(data) {
    document.getElementById('social-dialog-holder').querySelector('input[name="i"]').value = data.ID;
    document.getElementById('social-dialog-holder').querySelector('input[name="l"]').value = data.Value;
    let pm = new popup({
        id:'pmsg',
        target:'social-dialog',
        type:'steady'
    })
}

function socialLink(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'socialLink');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, null, null, false, '', '', 'timer');
        }
    };
}

function changePass(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'changePass');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, null, null, false, '', '', 'timer');
        }
    };
}

function loadEmails(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadEmails');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setEmails(data) {
    innerDom('email-holder', data, 'eml');
}

function loadComments(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadComments');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setComments(data) {
    innerDom('comment-holder', data, 'cmt');
}

function loadAddress(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadAddress');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setAddress(data) {
    document.getElementById('address-holder').innerText = data.value;
}

function addPhone() {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'addPhone');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function() {loadPhones(setPhones);}, null, true, '', '', 'timer');
        }
    };
}

function startPhone(obj) {
    let id = obj.getAttribute('kc-id');
    loadSinglePhone(phoneDialog, id);
}

function phoneDialog(data) {
    console.log(data);
    document.getElementById('phone-dialog-holder').querySelector('input[name="i"]').value = data.ID;
    document.getElementById('phone-dialog-holder').querySelector('input[name="p"]').value = data.value;
    let pm = new popup({
        id:'pmsg',
        target:'phone-dialog',
        type:'steady'
    })
}

function phone(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'phone');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function() {loadPhones(setPhones);}, null, false, '', '', 'timer');
        }
    };
}

function loadPhones(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadPhones');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setPhones(data) {
    innerDom('phone-holder', data, 'pho');
}

function loadSinglePhone(fn, id) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadSinglePhone');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function deletePhoneDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deletePhone(id);}
    })
}

function deletePhone(id) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'deletePhone');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadPhones(setPhones);
        }
    };
}

function loadSingleAddress(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadSingleAddress');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startAddress(obj) {
    loadSingleAddress(addressDialog);
}

function addressDialog(data) {
    innerDom('address-dialog-holder', data, 'adr');

    let fn = function() {
        kdsArray.push(DivSlider.create('address-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }

    let pm = new popup({
        id:'pmsg',
        target:'address-dialog',
        type:'steady',
        cb: fn
    })
}

function address(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'address');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadAddress(setAddress);}, null, false, '', '', 'timer');
        }
    };
}

function loadEmailAddress(fn) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData();
    f.append('f', 'loadEmailAddress');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function setEmailAddress(data) {
    document.getElementById('email-address-holder').innerText = data.value;
}

function startEmailAddress(obj) {
    loadEmailAddress(emailAddressDialog);
}

function emailAddressDialog(data) {
    document.getElementById('email-address-dialog-holder').querySelector('input[name="e"]').value = data.value;

    let pm = new popup({
        id:'pmsg',
        target:'email-address-dialog',
        type:'steady'
    })
}

function emailAddress(obj) {
    let page = root + 'pg/cal/settings.php';
    let f = new FormData(obj);
    f.append('f', 'emailAddress');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadEmailAddress(setEmailAddress);}, null, false, '', '', 'timer');
        }
    };
}



// ***************** BLOGS *******************

function loadBlogs(fn) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'loadBlogs');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function prepareBlogs(data) {
    for (let i = 0; i < data.length; i++) {
        projectClass.push('minimized');
    }
    // projectClass[0] = '';
    setBlogs(data);
}

function setBlogs(data) {
    data.forEach((el, ix) => {
        el.class = projectClass[ix];
    })
    innerDom('blogs', data, 'pjs', null, false, null);
}

function addBlog(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'addBlog');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, true, '', '', 'timer');
        }
    };
}

function loadSingleBlog(fn, id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'loadSingleBlog');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function blogActive(obj) {
    let act = 0;
    if (obj.checked) act = 1;
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'blogActive');
    f.append('act', act);
    f.append('id', obj.getAttribute('kc-id'));

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, null, null, true, '', '', 'timer');
        }
    };
}

function blogTitleDialog(data) {
    innerDom('blog-title-dialog-holder', data, 'ptd');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-title-dialog',
        type:'steady',
        cb: fn
    })
}

function startBlogTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlog(blogTitleDialog, id);
}

function blogTitle(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function startBlogExp(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlog(blogExpDialog, id);
}

function blogExpDialog(data) {
    innerDom('blog-exp-dialog-holder', data, 'ped');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-exp-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-exp-dialog',
        type:'steady',
        cb: fn
    })
}

function blogExp(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogExp');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function blogDescrDialog(data) {
    innerDom('blog-descr-dialog-holder', data, 'pdd');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-descr-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
        let eds = document.getElementById('blog-descr-dialog-popup').querySelectorAll('.editor');

        for (let i = 0; i < eds.length; i++) {

            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
              
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],     // superscript/subscript
              
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                ['image', 'video']
              ];
            var options = {
                modules: {
                  toolbar: toolbarOptions
                },
                readOnly: false,
                theme: 'snow'
            };
            let ed = eds[i];
            let editor = new Quill(ed, options);

            editor.on('text-change', function(delta, oldDelta, source) {
                let cont = ed.querySelector('p').parentElement.innerHTML;
                document.getElementById('blog-descr-dialog-popup').querySelectorAll('input[name="d"]')[i].value = cont;
            });
        }
        
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-descr-dialog',
        type:'steady',
        cb: fn,
        size:'lg'
    })
}

function startBlogDescr(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlog(blogDescrDialog, id);
}

function blogDescr(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogDescr');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function deleteBlogDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteBlog(id);}
    })
}

function deleteBlog(id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'deleteBlog');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadBlogs(setBlogs);
        }
    };
}

function toggleProject(obj) {
    let pid = obj.getAttribute('kc-pid');
    let val = obj.getAttribute('kc-val');
	let fn = val == 0 ? 'addBlogProject' : 'deleteBlogProject';
		
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', fn);
    f.append('pid', pid);
    f.append('id', obj.getAttribute('kc-bid'));

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            // let data = JSON.parse(request.responseText);
            // handleErr(data, null, null, true, '', '', 'timer');
			loadBlogs(setBlogs);
        }
    };
}







// ************ BLOG GALLERY ***************

function addBlogImage(obj) {
    slo();
    let id = obj.getAttribute('kc-id');
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'addBlogImage');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);elo();}, null, true, '', '', 'timer');
        }
    };
}

function startBlogImage(obj) {
    let id = obj.getAttribute('kc-id');
    document.getElementById('blog-image-dialog').querySelectorAll('input[type="hidden"')[0].value = id;
    let pm = new popup({
        id:'pmsg',
        target:'blog-image-dialog',
        type:'steady'
    })
}

function submitBlogImage(obj) {
    slo();
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogImage');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            elo();
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function loadSingleBlogImage(fn, id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'loadSingleBlogImage');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startBlogImageTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlogImage(blogImageTitleDialog, id);
}

function blogImageTitleDialog(data) {
    innerDom('blog-image-title-dialog-holder', data, 'pgtd');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-image-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-image-title-dialog',
        type:'steady',
        cb: fn
    })
}

function blogImageTitle(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogImageTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function deleteBlogImageDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteBlogImage(id);}
    })
}

function deleteBlogImage(id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'deleteBlogImage');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadBlogs(setBlogs);
        }
    };
}




// ****************** BLOG VIDEO *******************

function addBlogVideo(obj) {
    let id = obj.getAttribute('kc-id');
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'addBlogVideo');
    f.append('id', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, true, '', '', 'timer');
        }
    };
}

function startBlogVideo(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlogVideo(blogVideoDialog, id);
}

function blogVideoDialog(data) {
    innerDom('blog-video-dialog-holder', data, 'pvd');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-video-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-video-dialog',
        type:'steady',
        cb: fn
    })
}

function blogVideo(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogVideo');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function loadSingleBlogVideo(fn, id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'loadSingleBlogVideo');
    f.append('i', id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            fn(data);
        }
    };
}

function startBlogVideoTitle(obj) {
    let id = obj.getAttribute('kc-id');
    loadSingleBlogVideo(blogVideoTitleDialog, id);
}

function blogVideoTitleDialog(data) {
    innerDom('blog-video-title-dialog-holder', data, 'pvtd');

    let fn = function() {
        kdsArray.push(DivSlider.create('blog-video-title-dialog-popup'));
        kdsArray[kdsArray.length -1].initialize();
        kdsArray[kdsArray.length -1].update();
    }
    let pm = new popup({
        id:'pmsg',
        target:'blog-video-title-dialog',
        type:'steady',
        cb: fn
    })
}

function blogVideoTitle(obj) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData(obj);
    f.append('f', 'blogVideoTitle');

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(request.responseText);
            handleErr(data, function(){loadBlogs(setBlogs);}, null, false, '', '', 'timer');
        }
    };
}

function deleteBlogVideoDialog(obj) {
    let id = obj.getAttribute("kc-id");
    let pmsg = new popup({
        id:'del-pop',
        msg:'Do you want to proceed?',
        type:'steady',
        isYesNo: true,
        yesFunction: function(){deleteBlogVideo(id);}
    })
}

function deleteBlogVideo(id) {
    let page = root + 'pg/cal/blog.php';
    let f = new FormData();
    f.append('f', 'deleteBlogVideo');
    f.append("id", id);

    let request = new XMLHttpRequest();

    request.open('post', page);
    request.send(f);

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            loadBlogs(setBlogs);
        }
    };
}



