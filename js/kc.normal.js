// ******************** COOKIES *****************

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function delCookie(cname) {
	document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

// ********************* SAFETY **********************

function ec(unsafe) {
  if (isNaN(unsafe)) {
    return unsafe
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  } else {
    return unsafe;
  }
}

function sortTable(col, tableID) {
  let table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById(tableID);
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;

    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      if (rows[i].getElementsByTagName("TD")[col] != undefined) {
        x = rows[i].getElementsByTagName("TD")[col];
        y = rows[i + 1].getElementsByTagName("TD")[col];
        // Check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

function filterTable(o) {
  let input, filter, table, tr, td, i, display;
  input = document.getElementById(o.input);
  filter = input.value.toUpperCase();
  tables = o.tables;
  for (let k = 0; k < tables.length; k++) {
    table = document.getElementById(tables[k]);
    if (table != null) {
      tbody = table.getElementsByTagName("tbody");
      tr = tbody[0].getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        display = "none";
        for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              display = "table-row";
            }
          }
        }
        tr[i].style.display = display;
      }
    }
  }
}

function unfilterTable(o) {
  tables = o.tables;
  display = "table-row";
  for (let k = 0; k < tables.length; k++) {
    table = document.getElementById(tables[k]);
    if (table != null) {
      tbody = table.getElementsByTagName("tbody");
      tr = tbody[0].getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        tr[i].style.display = display;
      }
    }
  }
}

function readURL(input, data) {
  let div  = document.getElementById(data.div);
  div.innerHTML = '';
  for (let i = 0; i < input.files.length; i++) {
    let reader = new FileReader();
    reader.onload = function(e) {
      let img = document.createElement('img');
      img.classList.add(data.class);
      img.src = e.target.result;
      div.appendChild(img);
    }
    reader.readAsDataURL(input.files[i]);
  }
}

function combo(o) {
  let k = o.k;
  let v = o.v;
  let t = o.t;
  let d = o.d;
  let a = o.a;
  let cc = o.cc;
  let cv = o.cv;
  let func = o.func;
  let selectedVal = o.sval;
  let all = o.all;
  let ot = o.ot;
  let cb = o.cb;
  let pg = root + 'pg/cal/cheader.cal.php';
  let f = new FormData();
  if (o.lang != undefined) {
    f.append('lang', o.lang);
  }
  f.append('keyName', k);
  f.append('value', v);
  f.append('table', t);
  f.append('alt', a);
  if (cc) {
    f.append('condCol', cc);
    f.append('condVal', cv);
  }
  f.append('function', 'combo');

  let request = new XMLHttpRequest();

  request.open('post', pg);
  request.send(f);

  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(request.responseText);
      let div = document.getElementById(d);
      div.innerHTML = "";
      if (all) {
        let opt = document.createElement('option');
        opt.value = 'all';
        if (lang != 'fa') {
          opt.innerHTML = 'All';
        } else {
          opt.innerHTML = 'همه';
        }
        opt.setAttribute('data-alt', 'all');
        div.appendChild(opt);
      }
      for (let i = 0; i < data.length; i++) {
        let opt = document.createElement('option');
        opt.value = data[i].Value;
        opt.innerHTML = data[i].Text;
        opt.setAttribute('data-alt', data[i].Alt);
        div.appendChild(opt);
      }
      if (ot) {
        let opt = document.createElement('option');
        opt.value = '0';
        opt.innerHTML = 'سایر';
        div.appendChild(opt);
      }
      if (func != undefined) {
        let inp = {
          id: d,
          val: selectedVal
        }
        runFunc(func, inp);
      }
      if (cb) {
        cb();
      }
    }
    i

  };

}

function runFunc(func, inp) {
  let fn = window[func];
  if (typeof fn === 'function') {
    fn(inp);
  }
}

function setSelctedOptionByVal(inp) {
  let event = new Event('change');
  let id = inp.id;
  let val = inp.val;
  let el = document.getElementById(id);
  el.value = val;
  // $('#' + id +' option[value='+val+']').attr('selected','selected');
  el.value = val;
  el.dispatchEvent(event);
}




// *********************** EXCEL *****************

function fnExcelReport(data) {
  let headerID = data.id;
  let target = data.target;
  let title = data.title;
  let tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
  let textRange;
  let j = 0;
  tab = document.getElementById(headerID); // id of table

  for (j = 0; j < tab.rows.length; j++) {
    tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
    //tab_text=tab_text+"</tr>";
  }

  tab_text = tab_text + "</table>";
  tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
  tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
  tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

  let ua = window.navigator.userAgent;
  let msie = ua.indexOf("MSIE ");

  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
  {
    txtArea1.document.open("txt/html", "replace");
    txtArea1.document.write(tab_text);
    txtArea1.document.close();
    txtArea1.focus();
    sa = txtArea1.document.execCommand("SaveAs", true, title + ".xls");
  } else //other browser not tested on IE 11
    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

  return (sa);
}

// ********************* WINDOW EVENTS ****************

function delegate(el, evt, sel, handler) {
  el.addEventListener(evt, function(event) {
      var t = event.target;
      while (t && t !== this) {
          if (t.matches(sel)) {
              handler.call(t, event);
          }
          t = t.parentNode;
      }
  });
}

/******************* EVENTS ****************/

  delegate(document, 'click', '[kc-mode="func-btn"]', function(e){
    let att = this.getAttribute('kc-func');
    let fn = window[att];
    if (typeof fn === 'function') {
      fn(this);
    }
  })

  delegate(document, 'click', '.password .show', function(e){
    let inp = this.parentElement.querySelector('input');
    if (inp.type == 'text') {
      inp.type = 'password';
    } else {
      inp.type = 'text';
    }
  })

  delegate(document, 'change', '.fake-file', function(){
    let par = this.parentElement;
    if (Array.from(par.classList).indexOf('fake') > -1) {
      par.querySelectorAll('input[type="text"]')[0].value = this.value;
    }
  })

  delegate(document, 'submit', '[kc-mode="form-submit"]', function(e){
    e.preventDefault();
    let att = this.getAttribute('kc-func');
    let fn = window[att];
    if (typeof fn === 'function') {
      fn(this);
    }
  })

  delegate(document, 'click', '.image-view', function(){
    let img = document.createElement('img');
    img.src = this.src;
    img.style.width = '100%';
    let div = document.createElement('div');
    div.classList = "row";
    div.appendChild(img);
    let pop = new popup({
      msg:div,
      type:'steady',
      id:'image-viewer',
      size: 'xl'
    });
  })


  let tgsrs = document.querySelectorAll('[kc-mode="tag-search"]');
  Array.from(tgsrs).forEach(function(tgsr){
    let kw = tgsr.value;
    let target = document.getElementById(tgsr.getAttribute('data-target'));
    let elms = target.getElementsByClassName('tag');
    if (elms.length == 0) {
      elms = target.getElementsByClassName('radiotag');
    }

    if (kw.length > 1) {
      let start = kw.length - Math.min((kw.length - 1), 3)
      for (let i = start; i < kw.length; i++) {
        let len = i + 1;
        for (let j = 0; j < kw.length - i; j++) {
          let val = kw.substr(j, len);
          for (let i = 0; i < elms.length; i++) {
            if (!elms[i].innerHTML.includes(val) && !elms[i].innerHTML.toLowerCase().includes(val)) {
              elms[i].style.display = 'none';
            } else {
              elms[i].style.display = 'inline-block';
            }
          }
        }
      }
    } else {
      for (let i = 0; i < elms.length; i++) {
        elms[i].style.display = 'inline-block';
      }
    }
  })

  let tags = document.getElementsByClassName('tag');
  Array.from(tags).forEach(function(tag) {
    tag.addEventListener('click', function(){
      let span = this;
      let pt = span.parentNode;
      let elm = pt.getElementsByClassName('selected-tag')[pt.getElementsByClassName('selected-tag').length - 1];
      if (elm == undefined) {
        let place = pt.firstChild;
      } else {
        let place = elm.nextElementSibling;
      }
      pt.insertBefore(span, place);
      if ( (" " + this.className + " ").replace(/[\n\t]/g, " ").indexOf(" selected-tag ") > -1 ) {
        this.classList.add('bg-grey-5');
        this.classList.remove('bg-cyan-3', 'selected-tag');
      } else {
        this.classList.remove('bg-grey-5');
        this.classList.add('bg-cyan-3', 'selected-tag');

      }
    });
  })

  let rdtgs = document.getElementsByClassName('radiotag');
  Array.from(rdtgs).forEach(function(rdtg){
    rdtg.addEventListener('click', function(){
      this.parent.querySelectorAll('radiotag').forEach(function(elm){
        elm.classList.add('bg-grey-5');
        elm.classList.remove('bg-cyan-5', 'selected-radiotag');
      })
      this.classList.remove('bg-grey-5')
      this.classList.add('bg-cyan-5', 'selected-radiotag')
    })
  })


  let sideBar = document.getElementById('side-bar');
  if (sideBar) {
    sideBar.addEventListener('mouseenter', function(){
      sideBar.classList.add('open');
    })

    sideBar.addEventListener('mouseleave', function(){
        sideBar.classList.remove('open');
    })
  }

function innerMsg(div, msg) {
  div.innerHTML = "";
  let h3 = document.createElement('h3');
  h3.style.textAlign = 'center';
  h3.style.color = '#555';
  h3.innerHTML = msg;
  div.appendChild(h3);
}


function removeTag(obj) {
  obj.parentElement.parentElement.removeChild(obj.parentElement);
}

function getNearestTableAncestor(htmlElementNode) {
  while (htmlElementNode) {
    htmlElementNode = htmlElementNode.parentNode;
    if (htmlElementNode.tagName.toLowerCase() === 'table') {
      return htmlElementNode;
    }
  }
  return undefined;
}

function getNearestTrAncestor(htmlElementNode) {
  while (htmlElementNode) {
    htmlElementNode = htmlElementNode.parentNode;
    if (htmlElementNode.tagName.toLowerCase() === 'tr') {
      return htmlElementNode;
    }
  }
  return undefined;
}

function innerFast(o) {
  let tg = o.target;
  let doc;
  if (tg) {
    doc = document.getElementById(tg);
  } else {
    doc = document;
  }
  let data = o.data;
  let keys = Object.keys(data);
  for (let i = 0; i < keys.length; i++) {
    let elm = doc.querySelectorAll('[data-kval="' + keys[i] + '"]');
    if (data[keys[i]] === null) {
      data[keys[i]] = 'ندارد';
    }
    elm.forEach((item, j) => {
      let att = item.getAttribute('data-key');
      switch (att) {
        case 'html':
          item.innerHTML = data[keys[i]];
          break;
        case 'src':
          if (data[keys[i]] == 'None') {
            data[keys[i]] = 'img/no_user_image.jpg';
          }
          item.src = root + data[keys[i]];
          break;

        case 'uri':
          item.src = data[keys[i]];
          break;

        case 'val':
          item.value = data[keys[i]];
          break;

        case 'bg':
          item.style.background = 'url("' + root + data[keys[i]] + '")';
          break;
        default:
      }
    });
  }
}

function innerFast2(o){
  let maxStr, ids;
  o.maxStr ? maxStr = o.maxStr : maxStr = 0;
  let tg = o.target;
  let doc;
  if (tg) {
    doc = document.getElementById(tg);
    ids = tg;
  } else {
    doc = document;
    ids = "doc";
  }
  let data = o.data;
  let att = doc.outerHTML;
  let parent = doc.parentElement;
  let idx = [].slice.call(parent.children).indexOf(doc);
  if (att.match(/\[\[(.*?)\]\]/g)) {
    let key = att.match(/\[\[(.*?)\]\]/g);
    for (let i = 0; i < key.length; i++) {
      let k = key[i].replace("[[", "").replace("]]", "");
      if (k == "Row") {
        doc.outerHTML = doc.outerHTML.replace(key[i],o.row);
        doc = parent.children[idx];
      } else if (k == "Index") {
        doc.outerHTML = doc.outerHTML.replace(key[i],(o.row - 1));
        doc = parent.children[idx];
      } else if (k.slice(0, 1) == '/') {
        k = k.replace('/', '');
        let newElm = doc.querySelectorAll("[data-sel='"+key[i]+"']")[0];
        setSelctedOptionByVal({id:newElm.id, val:data[k]});
      } else if (k.slice(0, 1) == '$') {
          let elm = doc.querySelectorAll("[kc-arr='"+key[i]+"']")[0];
          k = k.replace('$', '');
          innerDom(elm, data[k], ids + '-' + k, null, true, null);
      } else {
        if (data[k] === undefined) {
          data[k] = '*';
        }
        if (typeof data[k].slice === 'function') {
          if (maxStr && data[k].length > maxStr) {
            doc.outerHTML = doc.outerHTML.replace(key[i], data[k].slice(0, maxStr) + '...');
            doc = parent.children[idx];
          } else {
            doc.outerHTML = doc.outerHTML.replace(key[i], data[k]);
            doc = parent.children[idx];
          }
        } else {
          doc.outerHTML = doc.outerHTML.replace(key[i], data[k]);
          doc = parent.children[idx];
        }

      }
    }
  }
  if (o.cb) {
    o.cb();
  }
}

class InFast {
  constructor(o) {
    this.maxStr = o.maxStr || 0;
    this.fakeID = o.target;
    this.tg = o.target;
    this.doc = null;
    if (this.tg) {
      this.doc = document.getElementById(this.tg);
      this.ids = this.tg;
    } else {
      this.doc = document;
      this.ids = "doc";
    }
    this.data = o.data;
    let rawDoc = this.doc.cloneNode(true);
    let subs = rawDoc.querySelectorAll('.karaco-sample-dom');
    subs.forEach((el) => {
      el.parentElement.removeChild(el);
    })
    this.att = rawDoc.outerHTML;
    this.parent = this.doc.parentElement;
    this.idx = [].slice.call(this.parent.children).indexOf(this.doc);
    if (this.att.match(/\[\[(.*?)\]\]/g)) {
      this.key = this.att.match(/\[\[(.*?)\]\]/g);
    }
    this.row = o.row;
    this.k = null;
    if (o.cb) {
      this.cb = o.cb;
    } else {
      this.cb = null;
    }
  }

  update() {
    for (let i = 0; i < this.key.length; i++) {
      this.k = this.key[i].replace("[[", "").replace("]]", "");
      if (this.k == "Row") {
        this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i],this.row);
        this.doc = this.parent.children[this.idx];
      } else if (this.k == "Index") {
        this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i],(this.row - 1));
        this.doc = this.parent.children[this.idx];
      } else if (this.k == "fakeID") {
        this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i],this.fakeID);
        this.doc = this.parent.children[this.idx];
      } else if (this.k.slice(0, 1) == '/') {
        this.k = this.k.replace('/', '');
        let newElm = this.doc.querySelectorAll("[data-sel='"+this.key[i]+"']")[0];
        setSelctedOptionByVal({id:newElm.id, val:data[k]});
      } else if (this.k.slice(0, 1) == '$') {
          let elm = this.doc.querySelectorAll("[kc-arr='"+this.key[i]+"']")[0];
          this.k = this.k.replace('$', '');
          innerDom(elm, this.data[this.k], this.ids + '-' + this.k, null, true, null);
      } else {
        if (this.data[this.k] === undefined) {
          this.data[this.k] = '*';
        }
        if (typeof this.data[this.k].slice === 'function') {
          if (this.maxStr && this.data[this.k].length > this.maxStr) {
            this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i], this.data[this.k].slice(0, this.maxStr) + '...');
            this.doc = this.parent.children[this.idx];
          } else {
            this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i], this.data[this.k]);
            this.doc = this.parent.children[this.idx];
          }
        } else {
          this.doc.outerHTML = this.doc.outerHTML.replace(this.key[i], this.data[this.k]);
          this.doc = this.parent.children[this.idx];
        }
      }
    }

    if (this.cb) {
      this.cb();
    }
    
  }
}

function innerDom(id, data, l, cb, del, rep, maxStr){
  let parent, target;
  infs = [];

  if (checkType(id) === 'String') {
    target = document.getElementById(id);
  } else {
    target = id;
  }

  parent = target.querySelector('.karaco-sample-dom').parentElement;

  if (rep) {
    let container = parent.getElementsByClassName('karaco-sample-container')[0];
    let container1 = container.cloneNode(true);
    if (del) {
      container.parentNode.removeChild(container);
    }
    container1.classList.remove("karaco-sample-container");
    let len = Math.ceil(data.length / rep);
    for (let i = 0; i < len; i++) {
      let cont = container1.cloneNode(true);
      if (!l) {
        let l = 'c';
      }
      cont.id = l + '-container-' + i;
      parent.appendChild(cont);
      let smp = cont.getElementsByClassName('karaco-sample-dom')[0];
      let smpParnt = smp.parentNode;      
      for (let j = i * rep; j < Math.min((i+1) * rep, data.length); j++) {
        let d = data[j];
        let clone = smp.cloneNode(true);
        clone.classList.remove("karaco-sample-dom");
        if (!l) {
          let l = 'c';
        }
        clone.id = l + '-' + j;
        smpParnt.appendChild(clone);
        // innerFast2({data:d, target:clone.id, row:j+1, maxStr:maxStr});
        let inf = new InFast({data:d, target:clone.id, row:j+1, maxStr:maxStr});
        inf.update()
        infs.push(inf);
      }
    }
  } else {
    let smp = parent.getElementsByClassName('karaco-sample-dom')[0];
    let spm1 = smp.cloneNode(true);
    parent.innerHTML = "";
    if (!del) {
      parent.appendChild(spm1);
    }
    smp.classList.remove("karaco-sample-dom");
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        let d = data[i];
        let clone = smp.cloneNode(true);
        if (!l) {
          let l = 'c';
        }
        clone.id = l + '-' + i;
        parent.appendChild(clone);
        // innerFast2({data:d, target:clone.id, row:i+1, maxStr:maxStr});
        let inf = new InFast({data:d, target:clone.id, row:i+1, maxStr:maxStr});
        inf.update()
        infs.push(inf);
      }
    }
  }

  if (cb) {
    cb();
  }
}

function innerSingleDom(id, data, cb){
  let parent = document.getElementById(id);
  let d = data;
  innerFast2({data:d, target:parent.id, cb:cb});
}

function loadSelectData(id, callback){
  if (id) {
    let doc = document.getElementById(id);
  } else {
    let doc = document;
  }

  let elms = doc.querySelectorAll("[data-mode='karaco-select']");
  for (let i = 0; i < elms.length; i++) {
    let el = elms[i];
    if (!el.id) {
      el.id = 'kc-sel-' + (Math.floor(Math.random() * 10000) + 10000);
    }
    let keys = el.getAttribute('data-keys').split(" ");
    let o = {
      t:keys[0],
      k:keys[1],
      v:keys[2],
      a:keys[3],
      d:el.id
    }
    keys[4] == "null" ? true : o.cc = keys[4];
    keys[5] == "null" ? true : o.cv = keys[5];
    keys[6] == "true" ? o.ot = true : o.ot = false;
    if (i == elms.length - 1) {
      if (callback) {
        o.cb = callback;
      }
    }
    combo(o);
  }
}

function copyElements(id){
  if (id) {
    let doc = document.getElementById(id);
    let docTo = document.getElementById(id);
  } else {
    let doc = document;
    let docTo = document.body;
  }

  let elms = doc.querySelectorAll("[data-mode='karaco-copy']");
  for (let i = 0; i < elms.length; i++) {
    let el = elms[i].cloneNode(true);
    el.id += '-copy';
    docTo.appendChild(el);
  }
}

function handleModalExit(obj){
  let id = obj.id;
  if (document.getElementById(id+'-copy')) {
    obj.remove();
    let cln = document.getElementById(id+'-copy').cloneNode(true);
    cln.id = id;
    document.body.appendChild(cln);
    loadSelectData(id);
  }
}

function lastElm(arr){
  return arr[arr.length - 1];
}

function firstElm(arr){
  return arr[0];
}

function lastWord(str){
  return lastElm(str.split(" "));
}

String.prototype.replaceAt = function(i, str) {
  return this.substr(0, i) + str + this.substr(i + str.length);
}

String.prototype.replaceFromTo = function(s, e, str) {
  return this.substr(0, s) + str + this.substr(e + str.length);
}


String.prototype.addToIndex = function(i, str){
  return this.slice(0, i) + str + this.slice(i);
}

String.prototype.cut = function(s, e){
  if (e == undefined) {
    let e = this.length; 
  }
  return this.substr(0, s) + this.substr(e);
}

String.prototype.extract = function(s, e){
  if (e == undefined) {
    let e = this.length; 
  }
  return this.substr(s, e);
}

String.prototype.cutLastWord = function(){
  let arr = this.split(" ");
  arr.pop();
  let newStr = arr.join(" ");
  return newStr;
}

String.prototype.firstWord = function(){
  return firstElm(this.split(" "));
}

String.prototype.lastWord = function(){
  return lastElm(this.split(" "));
}

HTMLInputElement.prototype.setFilter = function() {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    this.addEventListener(event, function() {
      if (/^\d*\.?\d*$/.test(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

HTMLElement.prototype.getAllChildren = function() {
  let arr = [];
  let arr2 = [];
  for (let i = 0; i < this.children.length; i++) {
    const elm = this.children[i];
    arr.push(elm);
    arr2 = elm.getAllChildren();
    for (let j = 0; j < arr2.length; j++) {
      const elm2 = arr2[j];
      arr.push(elm2);
    }
  }
  return arr;
}

function checkType(item){
  let stringConstructor = "test".constructor;
  let arrayConstructor = [].constructor;
  let objectConstructor = ({}).constructor;

  if (item === null) {
      return "null";
  }
  if (item === undefined) {
      return "undefined";
  }
  if (item.constructor === stringConstructor) {
      return "String";
  }
  if (item.constructor === arrayConstructor) {
      return "Array";
  }
  if (item.constructor === objectConstructor) {
      return "Object";
  }
  if (typeof item === 'function') {
      return "Function";
  }
  if (item instanceof HTMLElement) {
    return "Dom";
  }
  {
      return "don't know";
  }
}

function eventFire(el, etype){
  if (el.fireEvent) {
    el.fireEvent('on' + etype);
  } else {
    let evObj = document.createEvent('Events');
    evObj.initEvent(etype, true, false);
    el.dispatchEvent(evObj);
  }
}

function deleteDialog(id, fn){
  let msg = 'از انجام این عملیات اطمینان دارید؟';
  let msgpop = new popup({id:'msgpop',
    msg:msg,
    isYesNo:true,
    type:'steady',
    yesFunction: function(){fn(id);}
  })
}










// ******************* EMITTER ****************

class EventEmitter {
  constructor() {
      this.events = {};
  }

  on(eventName, callback){
      if (this.events[eventName]) {
          this.events[eventName].push(callback);
      } else {
          this.events[eventName] = [callback];
      }
  }

  trigger(eventName, ...rest) {
      if (this.events[eventName]) {
          this.events[eventName].forEach(cb => {
              cb.apply(null, rest);
          });
      }
  }
}


// ******************** CALENDAR ******************
let today;

function getToday(fn){
  let page = root + 'pg/cal/cheader.cal.php';
  let f = new FormData();
  f.append('f', 'getToday');

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


getToday(function(date){
  today = date;
});

var calArray = [];
function CreatCalendar(o){
  this.initialize(o);
  if (this.inputID != null) {
    this.input = this.inputID;
    this.createBtn();
  }

  var css = '#time-holder input::-webkit-outer-spin-button,#time-holder input::-webkit-inner-spin-button {-webkit-appearance: none;margin: 0;}#time-holder input[type=number]{-moz-appearance: textfield;}';
  var style = document.createElement('style');

  if (style.styleSheet) {
      style.styleSheet.cssText = css;
  } else {
      style.appendChild(document.createTextNode(css));
  }

  document.getElementsByTagName('head')[0].appendChild(style);
}

var proto = CreatCalendar.prototype;

proto.createTime = function(){
  var div = document.createElement('div');
  var div1 = document.createElement('div');
  var div2 = document.createElement('div');
  var div3 = document.createElement('div');
  var hi = document.createElement('input');
  var mi = document.createElement('input');
  var si = document.createElement('input');
  var sp1 = document.createElement('span');
  var sp2 = document.createElement('span');
  var miUp = document.createElement('span');
  var miDown = document.createElement('span');
  var siUp = document.createElement('span');
  var siDown = document.createElement('span');
  var hiUp = document.createElement('span');
  var hiDown = document.createElement('span');
  var h2 = document.createElement('h4');
  var tr = document.createElement('tr');
  var td = document.createElement('td');

  // div1.className = 'row';
  // div2.className = 'row';
  // div3.className = 'row';
  miUp.className = 'icon-chevron-circle-up';
  miUp.style.color = '#777';
  miUp.style.cursor = 'pointer';
  miUp.style.margin = '0 13px 10px 13px';
  miUp.style.fontSize = '24px';
  miUp.style.display = 'inline-block';
  miDown.className = 'icon-chevron-circle-up cl-grey-7 txt-hvr-blue clickable fs-24 dsp-ib ro-180 mg-t-5 mg-r-15 mg-l-15';
  miDown.style.color = '#777';
  miDown.style.cursor = 'pointer';
  miDown.style.margin = '10px 13px 0 13px';
  miDown.style.fontSize = '24px';
  miDown.style.display = 'inline-block';
  miDown.style.transform = 'rotate(180deg)';
  hiUp.className = 'icon-chevron-circle-up';
  hiUp.style.color = '#777';
  hiUp.style.cursor = 'pointer';
  hiUp.style.margin = '0 13px 10px 13px';
  hiUp.style.fontSize = '24px';
  hiUp.style.display = 'inline-block';
  hiDown.className = 'icon-chevron-circle-up';
  hiDown.style.color = '#777';
  hiDown.style.cursor = 'pointer';
  hiDown.style.margin = '10px 13px 0 13px';
  hiDown.style.fontSize = '24px';
  hiDown.style.display = 'inline-block';
  hiDown.style.transform = 'rotate(180deg)';
  siUp.className = 'icon-chevron-circle-up';
  siUp.style.color = '#777';
  siUp.style.cursor = 'pointer';
  siUp.style.margin = '0 13px 10px 13px';
  siUp.style.fontSize = '24px';
  siDown.className = 'icon-chevron-circle-up';
  siDown.style.color = '#777';
  siDown.style.cursor = 'pointer';
  siDown.style.margin = '10px 13px 0 13px';
  siDown.style.fontSize = '24px';
  siDown.style.display = 'inline-block';
  siDown.style.transform = 'rotate(180deg)';

  hiUp.onclick = this.changeHourByVal.bind(this, 1);
  hiDown.onclick = this.changeHourByVal.bind(this, -1);
  miUp.onclick = this.changeMinuteByVal.bind(this, 1);
  miDown.onclick = this.changeMinuteByVal.bind(this, -1);
  siUp.onclick = this.changeSecondByVal.bind(this, 1);
  siDown.onclick = this.changeSecondByVal.bind(this, -1);

  h2.style.marginTop = '15px';
  h2.style.padding = '5px';

  div.className = 'txt-c';
  h2.innerHTML = this.titleArray[this.lang].time;
  sp1.innerHTML = ' : ';
  sp2.innerHTML = ' : ';
  sp1.style.color = '#777';
  sp2.style.color = '#777';
  div.id = 'time-holder';
  hi.oninput = this.hourChange.bind(this);
  this.hi = hi;
  hi.type = 'number';
  hi.style.width = '35px';
  hi.style.height = '35px';
  hi.style.textAlign = 'center';
  hi.style.borderRadius = '0.25em';
  hi.style.border = 'none';
  hi.value = this.h;
  mi.oninput = this.minuteChange.bind(this);
  this.mi = mi;
  mi.type = 'number';
  mi.style.width = '35px';
  mi.style.height = '35px';
  mi.style.textAlign = 'center';
  mi.style.borderRadius = '0.25em';
  mi.style.border = 'none';
  mi.value = this.m;
  si.oninput = this.secondChange.bind(this);
  this.si = si;
  si.type = 'number';
  si.style.width = '35px';
  si.style.height = '35px';
  si.style.textAlign = 'center';
  si.style.borderRadius = '0.25em';
  si.style.border = 'none';
  si.value = this.s;
  td.setAttribute('colspan', 7);
  div1.appendChild(siUp);
  div1.appendChild(miUp);
  div1.appendChild(hiUp);
  div3.appendChild(siDown);
  div3.appendChild(miDown);
  div3.appendChild(hiDown);
  div2.appendChild(si);
  div2.appendChild(sp1);
  div2.appendChild(mi);
  div2.appendChild(sp2);
  div2.appendChild(hi);
  div.appendChild(h2);
  div.appendChild(div1);
  div.appendChild(div2);
  div.appendChild(div3);
  td.appendChild(div);
  tr.appendChild(td);

  this.table.appendChild(tr);
}

proto.btnclick =  function(){
  this.state = 'block';
  this.create();
  // this.state == 'none' ? this.state = 'block' : this.state = 'none';
  this.show();
  this.arrangeSelectedDays();
}

proto.initialize = function(o){
  this.titleArray = {en:{main:"Pick a date", time:"Pick a time", go:"Go", em:"E.g."}, fa:{main:"انتخاب تاریخ", time:"انتخاب ساعت", go:"برو", em:"مثال"}};
  this.title = o.title;
  this.year = o.year;
  this.month = o.month - 1;
  this.day = 1;
  this.id = o.id;
  this.lang = o.lang || 'en';
  this.friday = o.friday;
  this.cellClick = o.cellClick;
  this.state = o.state;
  this.showbtn = o.showbtn;
  this.class = o.class;
  this.inputID = o.inputID || null;
  this.time = o.time || false;
  if (o.popupins) {
    this.popupins = o.popupins;
  }
  this.reserve = new Array();
  if (o.reserve.active) {
    this.reserve.active = o.reserve.active;
    this.reserve.callback = o.reserve.callback;
    this.reserve.loadfunc = o.reserve.loadfunc;
    this.reserve.others = new Array();
    this.reserve.mine = new Array();
    this.reserve.others.callback = this.arrangeReservedDates;
    this.reserve.mine.callback = this.arrangeReservedDatesMine;
    this.reserve.others.reservedData = new Array();
    this.reserve.mine.reservedData = new Array();
  } else {
    this.reserve.active = false;
  }
  this.dayArray = new Array();
  this.monthArray = new Array();
  this.kabiseArray = new Array();
  this.kabiseVal = new Array();
  this.kabiseMonth = new Array();
  this.kabiseMonthVal = new Array();
  this.weekArray = new Array();
  this.baseDay = new Array();
  this.baseMonth = new Array();
  this.baseYear = new Array();
  this.monthArray.fa = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
  this.dayArray.fa = [31,31,31,31,31,31,30,30,30,30,30,29];
  this.kabiseArray.fa = [0,4,8,12,16,20,24,29,33,37,41,45,49,53,57,62,66,70,74,78,82,86,90,95,99,103,107,111,115,119,124];
  this.kabiseVal.fa = 128;
  this.kabiseMonth.fa = 11;
  this.kabiseMonthVal.fa = {t:30, f:29};
  // this.weekArray.fa = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنج شنبه', 'جمعه'];
  this.weekArray.fa = ['ش', 'ی', 'د', 'س', 'چ', 'پ', 'ج'];
  this.monthArray.en = ['January', 'February', 'March', 'April', 'May', 'Jun', 'July', 'Agust', 'September', 'October', 'November', 'December'];
  this.dayArray.en = [31,28,31,30,31,30,31,31,30,31,30,31];
  this.kabiseVal.en = 4;
  this.kabiseMonth.en = 1;
  this.kabiseMonthVal.en = {t:30, f:28};
  this.kabiseArray.en = [0];
  this.weekArray.en = ['Sat','Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
  this.baseDay.fa = 5;
  this.baseMonth.fa = 10;
  this.baseYear.fa = 1397;
  this.baseDay.en = 3;
  this.baseMonth.en = 7;
  this.baseYear.en = 2019;
  this.today = today;
  this.table = document.createElement('table');
  this.table.id = this.id + '-calendar-table';
  if (this.reserve) {
    this.selectedDaysArray = new Array();
  }
}

proto.setInputDate = function(event){
  this.selectedDaysArray = new Array();
  if (event.target.nodeName == 'TD') {
    var date = event.target.getAttribute("data-date");
    this.selectedDaysArray.push(event.target.getAttribute("data-date"));
  } else {
    var date = event.target.parentNode.getAttribute("data-date");
    this.selectedDaysArray.push(event.target.parentNode.getAttribute("data-date"));
  }

  if (this.time) {
    this.h = this.h < 10 ? "0" + this.h : this.h;
    this.m = this.m < 10 ? "0" + this.m : this.m;
    this.s = this.s < 10 ? "0" + this.s : this.s;
    this.input.value = date + ' ' + this.h + ':' + this.m + ':' + this.s;
  } else {
    this.input.value = date;
  }

  if (this.showbtn) {
    // this.state = 'none';
    // this.show();
    this.popupins.exit();
  }

  this.arrangeSelectedDays();
}

proto.show = function(){
  var div = document.createElement('div');
  div.id = 'cal-holder';
  var calpop = new popup({id:'cal-s', msg:div, type:'fly'});
  this.popupins = calpop;
  document.getElementById(this.id).innerHTML = "";
  document.getElementById(this.id).appendChild(this.table);
  document.getElementById(this.id).style.display = this.state;
}

proto.isKabise = function(year){
  if (this.kabiseArray[this.lang].indexOf(year % this.kabiseVal[this.lang]) != -1) {
    if (this.lang == 'en') {
      if (year % 100 == 0){
        if (year % 400 == 0) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } else {
      return true;
    }
  } else {
    return false;
  }
}

proto.selectReserve = function(event){
  if (event.target.nodeName == 'TD') {
    if (this.selectedDaysArray.indexOf(event.target.getAttribute("data-date")) != -1 && !event.target.getAttribute('reserved')) {
      this.selectedDaysArray.splice(this.selectedDaysArray.indexOf(event.target.getAttribute("data-date")), 1);
      event.target.classList.remove('selected-day');
    } else if (!event.target.getAttribute('reserved')) {
      this.selectedDaysArray.push(event.target.getAttribute("data-date"));
    }
  } else {
    if (this.selectedDaysArray.indexOf(event.target.parentNode.getAttribute("data-date")) != -1 && !event.target.parentNode.getAttribute('reserved')) {
      this.selectedDaysArray.splice(this.selectedDaysArray.indexOf(event.target.parentNode.getAttribute("data-date")), 1);
      event.target.parentNode.classList.remove('selected-day');
    } else if (!event.target.parentNode.getAttribute('reserved')) {
      this.selectedDaysArray.push(event.target.parentNode.getAttribute("data-date"));
    }
  }
  this.arrangeSelectedDays();
}

proto.getThisDay = function(){
  var days = 0;
  var thisdays = 0;
  var basedays = 0;
  var yearDays = 365;

  if (this.year > this.baseYear[this.lang]) {
    for (var i = this.baseYear[this.lang]; i < this.year; i++) {
      if (isKabise = this.isKabise(i)) {
        this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].t;
        yearDays = 366;
      } else {
        this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].f;
        yearDays = 365;
      }
      days += yearDays;
    }
    for (var i = 0; i < this.month; i++) {
      thisdays += this.dayArray[this.lang][i];
    }
    thisdays += this.day;
    for (var i = 0; i < this.baseMonth[this.lang] - 1; i++) {
      basedays += this.dayArray[this.lang][i];
    }
    basedays += this.baseDay[this.lang];

    days += (thisdays - basedays);
  } else if (this.year < this.baseYear[this.lang]){
    for (var i = this.year; i < this.baseYear[this.lang]; i++) {
      if (isKabise = this.isKabise(i)) {
        this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].t;
        yearDays = 366;
      } else {
        this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].f;
        yearDays = 365;
      }
      days -= yearDays;
    }
    for (var i = 0; i < this.month; i++) {
      thisdays += this.dayArray[this.lang][i];
    }
    thisdays += this.day;
    for (var i = 0; i < this.baseMonth[this.lang] - 1; i++) {
      basedays += this.dayArray[this.lang][i];
    }
    basedays += this.baseDay[this.lang];

    days += (thisdays - basedays);
  } else {
    if (isKabise = this.isKabise(i)) {
      this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].t;
      yearDays = 366;
    } else {
      this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].f;
      yearDays = 365;
    }

    for (var i = 0; i < this.month; i++) {
      thisdays += this.dayArray[this.lang][i];
    }
    thisdays += this.day;
    for (var i = 0; i < this.baseMonth[this.lang] - 1; i++) {
      basedays += this.dayArray[this.lang][i];
    }
    basedays += this.baseDay[this.lang];

    days += (thisdays - basedays);
  }
  var laDay = (4 + days) % 7;
  if (laDay < 0) {
    laDay += 7;
  }
  var day = this.weekArray[this.lang][laDay];
  this.firstDay = laDay;
}

proto.create = function(){
  this.getThisDay();
  if (isKabise = this.isKabise(this.year)) {
    this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].t;
  } else {
    this.dayArray[this.lang][this.kabiseMonth[this.lang]] = this.kabiseMonthVal[this.lang].f;
  }

  if (this.input.value != null) {
    this.selectedDaysArray.push(this.input.value.split(" ")[0]);
  }
  var dateMonth = parseInt(this.month) + 1;
  dateMonth < 10 ? dateMonth = "0"+dateMonth : '';
  this.table.innerHTML = "";
  this.table.setAttribute('data', this.id);
  var tbody = document.createElement('tbody');
  var thead = document.createElement('thead');
  var tr = document.createElement('tr');
  var tr2 = document.createElement('tr');
  var th = document.createElement('th');
  var td1 = document.createElement('td');
  var td2 = document.createElement('td');
  var td3 = document.createElement('td');
  var td4 = document.createElement('td');
  th.innerHTML = '<span id="cal-title">'+this.titleArray[this.lang].main+'</span>';
  th.setAttribute("colspan", "7");
  tr.appendChild(th);
  thead.appendChild(tr);
  td1.innerHTML = '<span class="icon-left-arrow hvr-cl-blue-3 cal-next-month"></span>';
  td1.classList.add("calendar-operator", "hvr-cl-blue-3");
  td1.style.cursor = 'pointer';
  this.preBtn = td1;
  td4.innerHTML = '<span class="icon-right-arrow hvr-cl-blue-3 cal-pre-month"></span>';
  td4.classList.add("calendar-operator", "hvr-cl-blue-3");
  td4.style.cursor = 'pointer';
  this.nextBtn = td4;
  td2.setAttribute("colspan", "3");
  td2.innerHTML = '<span data="'+this.year+'" class="cal-year">'+this.year+'</span>';
  td2.classList.add("calendar-operator", "hvr-cl-blue-3");
  td2.style.cursor = 'pointer';
  this.yearBtn = td2;
  td3.setAttribute("colspan", "2");
  td3.innerHTML = '<span data="'+dateMonth+'" class="cal-month">'+this.monthArray[this.lang][this.month]+'</span>';
  td3.classList.add("calendar-operator", "hvr-cl-blue-3");
  td3.style.cursor = 'pointer';
  this.monthBtn = td3;
  tr2.appendChild(td1);
  tr2.appendChild(td2);
  tr2.appendChild(td3);
  tr2.appendChild(td4);
  tbody.appendChild(tr2);
  tbody.appendChild(document.createElement('tr'));
  var tr = document.createElement('tr');
  tbody.appendChild(tr);
  for (var i = 0; i < 7; i++) {
    var newTd = document.createElement('td')
    newTd.innerHTML = '<span>'+this.weekArray[this.lang][(i+this.firstDay) % 7] +'</span>';
    tr.appendChild(newTd);
  }
  for (var i = 0; i < this.dayArray[this.lang][this.month]; i++) {
    if (i % 7 == 0) {
      var newTr = document.createElement('tr');
    }
    var newTd = document.createElement('td');
    if (i == this.today.d - 1 && this.month == this.today.m - 1 && this.year == this.today.y) {
      newTd.classList.add('cal-today');
    } else if ((i+this.firstDay) % 7 == 6 && this.friday) {
      newTd.classList.add('cal-friday');
    }
    newTd.classList.add('cal-days');
    var dateDay = i + 1;
    dateDay < 10 ? dateDay = "0"+dateDay : '';
    newTd.setAttribute("data-date", (this.year) + "-" + dateMonth+ "-" + dateDay);
    newTd.innerHTML = '<span>'+ (i+1) +'</span>';
    newTd.onclick = this[this.cellClick].bind(this);
    newTr.appendChild(newTd);
    if (i % 7 == 0) {
      tbody.appendChild(newTr);
    }
  }

  if (this.reserve.active) {
    var resDiv = document.createElement('div');
    var txtDiv = document.createElement('div');
    var dateDiv = document.createElement('div');
    var btnDiv = document.createElement('div');
    var btn = document.createElement('button');
    var resTr = document.createElement('tr');
    var resTd = document.createElement('td');
    resDiv.classList.add('container');
    txtDiv.style.width = '30%';
    txtDiv.style.lineHeight = '35px';
    txtDiv.innerHTML = 'روزهای انتخابی';
    txtDiv.setAttribute('data-key', 'tf');
    dateDiv.style.width = '70%';
    dateDiv.style.minHeight = '35px';
    dateDiv.classList.add('ov-h');
    dateDiv.setAttribute('data-key', 'f');
    this.dateDiv = dateDiv;
    btnDiv.style.width = '100%';
    btnDiv.classList.add('pd-10', 'mg-t-20', 'f-r');
    resTd.setAttribute('colspan', 7);
    btn.innerHTML = 'رزرو';
    btn.setAttribute('data-key', 't');
    btn.classList.add('normal-btn-1', 'bg-green-5', 'hvr-blue', 'cl-white');
    btn.onclick = this.reserve.callback.bind(null, this.selectedDaysArray);
    btnDiv.appendChild(btn);
    resDiv.appendChild(txtDiv);
    resDiv.appendChild(dateDiv);
    resDiv.appendChild(btnDiv);
    resTd.appendChild(resDiv);
    resTr.appendChild(resTd);
    tbody.appendChild(resTr);
    this.arrangeSelectedDays();
    this.reserve.loadfunc.call(this, 'others');
    this.reserve.loadfunc.call(this, 'mine');
  }

  this.table.appendChild(thead);
  this.table.appendChild(tbody);
  this.table.classList.add(this.class);
  this.addEve();
  if (this.time) {
    if (this.input.value != undefined && this.input.value != '') {
      this.h = parseInt(this.input.value.split(" ")[1].split(":")[0]);
      this.m = parseInt(this.input.value.split(" ")[1].split(":")[1]);
      this.s = parseInt(this.input.value.split(" ")[1].split(":")[2]);
    } else {
      this.h = 0;
      this.m = 0;
      this.s = 0;
    }

    this.createTime();
  }
}

proto.createBtn = function(){
  let wraper = document.createElement('div');
  let ind = Array.from(this.input.parentElement.children).indexOf(this.input);
  wraper.style.position = 'relative';
  this.input.parentElement.insertBefore(wraper, this.input.parentElement.children[ind]);
  wraper.appendChild(this.input);
  var top =  (this.input.offsetTop + 1) + 'px';
  var left = (this.input.offsetLeft + 1) + 'px';
  var div = document.createElement('span');
  div.className = 'calendar-btn icon-calendar-1';
  div.style.left = left;
  div.style.top = top; 
  this.btn = div;
  wraper.appendChild(this.btn);
  this.btn.addEventListener('click', (e)=>{
    this.btnclick();
  }) 
}

proto.setBtnPosition = function(){
  var top =  (this.input.offsetTop + 1) + 'px';
  var left = (this.input.offsetLeft + 1) + 'px';
  this.btn.style.left = left;
  this.btn.style.top = top;

}

proto.next = function(){
  this.month += 1;
  if (this.month > 11) {
    this.month = 0;
    this.year += 1;
  }
  this.create();
}

proto.pre = function(){
  this.month -= 1;
  if (this.month < 0) {
    this.month = 11;
    this.year -= 1;
  }
  this.create();
}

proto.addEve = function(){
  this.nextBtn.onclick = this.next.bind(this);
  this.preBtn.onclick = this.pre.bind(this);
  this.monthBtn.onclick = this.monthShow.bind(this);
  this.yearBtn.onclick = this.yearShow.bind(this);
}

proto.monthShow = function(){
  var parent = document.getElementById(this.id);
  this.table.deleteRow(2);
  var tr = this.table.insertRow(2);
  var td = tr.insertCell(0);
  td.setAttribute('colspan', 7);
  var div = document.createElement('div');
  div.classList.add('container');
  div.style.overflow = 'hidden';
  div.style.borderRadius = '5px';
  div.style.display = 'flex';
  div.style.flexFlow = 'wrap';
  div.style.justifyContent = 'space-between';
  for (var i = 0; i < this.monthArray[this.lang].length; i++) {
    var div2 = document.createElement('div');
    div2.innerHTML = this.monthArray[this.lang][i];
    div2.classList.add('cal-month-title', "hvr-cl-blue-3");
    div2.style.width = '30%';
    div2.style.height = '45px';
    div2.style.lineHeight = '45px';
    div2.style.margin = '1%';
    div2.style.background = '#fff';
    div2.style.cursor = 'pointer';
    div2.setAttribute('data-id', i);
    div2.onclick = this.monthSelect.bind(this);
    div.appendChild(div2);
  }

  td.appendChild(div);
  this.monthDiv = div;
}

proto.monthSelect = function(event){
  this.month = event.target.getAttribute('data-id');
  this.table.deleteRow(2);
  this.create();
}

proto.yearShow = function(){
  var parent = document.getElementById(this.id);
  this.table.deleteRow(2);
  var tr = this.table.insertRow(2);
  var td = tr.insertCell(0);
  td.setAttribute('colspan', 7);
  var div = document.createElement('div');
  var btn = document.createElement('button');
  var inp = document.createElement('input');
  var inp2 = document.createElement('input');
  btn.setAttribute('data-key', 'tf');
  inp.setAttribute('data-key', 'f');
  div.style.overflow = 'hidden';
  div.className = 'dsp-f';
  inp.type = 'text';
  inp.style.border = 'none';
  inp.style.width = '75%';
  inp.setAttribute('placeholder', this.titleArray[this.lang].em + ' : ' + this.year);
  inp.classList.add('cal-year-input', 'p-x-1', 'p-y-2', 'txt-c');
  btn.innerHTML = this.titleArray[this.lang].go;
  btn.style.width = '25%';
  btn.style.border = 'none';
  btn.style.background = '#fff';
  btn.classList.add('cal-go', 'p-x-1', 'p-y-2', 'pointer', 'hvr-cl-blue-3');
  btn.onclick = this.yearSelect.bind(this);
  this.yearInp = inp;
  div.appendChild(inp);
  div.appendChild(btn);
  td.appendChild(div);
  this.yearDiv = div;
  // getTxtTranslate();
}

proto.yearSelect = function(){
  this.year = this.yearInp.value;
  this.create();
}

proto.arrangeSelectedDays = function(){
  if (this.reserve.active) {
    this.dateDiv.innerHTML = "";
  }
  for (var i = 0; i < this.selectedDaysArray.length; i++) {
    if (document.querySelectorAll('[data-date="'+this.selectedDaysArray[i]+'"]').length > 0) {
      document.querySelectorAll('[data-date="'+this.selectedDaysArray[i]+'"]')[0].classList.add('selected-day');
    }
    if (this.reserve.active) {
      var div = document.createElement('div');
      div.style.width = "100px";
      div.style.display = "inline-block";
      div.classList.add('pd-5', 'mg-5', 'bg-green-3', 'cl-white', 'txt-c');
      div.innerHTML = this.selectedDaysArray[i];
      this.dateDiv.appendChild(div);
    }
  }
}

proto.arrangeReservedDates = function(){
  for (var i = 0; i < this.reserve.others.reservedData.length; i++) {
    var elm = document.querySelectorAll('[data-date="'+this.reserve.others.reservedData[i].Dates+'"]');
    if ( elm.length > 0) {
      elm[0].classList.add('reserved-day');
      elm[0].setAttribute('reserved', 'true');
    }
  }
}

proto.arrangeReservedDatesMine = function(){
  for (var i = 0; i < this.reserve.mine.reservedData.length; i++) {
    var elm = document.querySelectorAll('[data-date="'+this.reserve.mine.reservedData[i].Dates+'"]');
    if ( elm.length > 0) {
      elm[0].classList.add('reserved-day-mine');
      elm[0].setAttribute('reserved', 'true');
    }
  }
}

proto.syncTime = function(){
  if (this.h > 23) {
    this.h = 0;
  } else if (this.h < 0) {
    this.h = 23;
  }

  if (this.m > 59) {
    this.m = 0;
  } else if (this.m < 0) {
    this.m = 59;
  }

  if (this.s > 59) {
    this.s = 0;
  } else if (this.s < 0) {
    this.s = 59;
  }

  this.hi.value = this.h;
  this.mi.value = this.m;
  this.si.value = this.s;
}

proto.secondChange = function(){
  this.s = this.si.value;
  this.syncTime();
}

 proto.minuteChange = function(){
  this.m = this.mi.value;
  this.syncTime();
}

 proto.hourChange = function(){
  this.h = this.hi.value;
  this.syncTime();
}

proto.changeHourByVal = function(val){
  var old = parseInt(this.hi.value)
  this.hi.value = old + parseInt(val);
  this.hourChange();
}

proto.changeMinuteByVal = function(val){
  var old = parseInt(this.mi.value)
  this.mi.value = old + parseInt(val);
  this.minuteChange();
}

proto.changeSecondByVal = function(val){
  var old = parseInt(this.si.value)
  this.si.value = old + parseInt(val);
  this.secondChange();
}

proto.destroy = function(){
  this.btn.remove();
  calArray.splice(calArray.indexOf(this), 1);
  this.table.remove();
}

function findCals(){
  var cals = document.getElementsByClassName('karaco-calendar');
  for (var i = 0; i < cals.length; i++) {
    var cal = cals[i];
    var time = cal.getAttribute("time");
    setCal(cal, time);
  }
}

function removeCals(){
  for (var cal in calArray) {
    if (calArray[cal]) {
      calArray[cal].destroy();
    }
  }
  var elms = document.getElementsByClassName('calendar-btn');
  for (var i = 0; i < elms.length; i++) {
    elms[i].remove();
  }

  if (elms.length == 0 && calArray.length == 0) {
    findCals();
  } else {
    removeCals();
  }
}

function setCal(cal, time){
  getToday(function(date){
    var today = date;
    showCal(today, cal, time);
  });
}

function showCal(today, cal, time){
  var cal = new CreatCalendar({
    id: 'cal-holder',
    time:time,
    class:'calendar-table-small',
    title: 'Pick a date',
    year: today.y,
    month: today.m,
    day: today.d,
    state: 'none',
    showbtn: true,
    reserve:{active:false, callback: 'none', loadfunc: 'none'},
    cellClick: 'setInputDate',
    friday:true,
    inputID: cal
  })
  calArray.push(cal);
}

function findInput(elm) {
    while (elm) {
        elm = elm.parentNode;
        if (elm.tagName.toLowerCase() === 'input') {
            return elm;
        }
    }
    return undefined;
}

window.addEventListener('resize', function(){
  for (var i = 0; i < calArray.length; i++) {
    var cal = calArray[i];
    cal.setBtnPosition();
  }
}, false);







// ************** DIV SLIDER *******************

let kdsArray = new Array();

let DivSlider = {
  create: function(){
    let id;
    let obj = Object.create(this);
    obj.loop = false;
    for (let i = 0; i < arguments.length; i++) {
      let arg = arguments[i];
      if (checkType(arg) === 'String') {
        if (arg === 'LOOP') {
          obj.loop = true;
        } else {
          id = arg;
        }
      }
    }
    obj.parent = document.getElementById(id);
    obj.children = obj.parent.querySelectorAll('[kc-mode="kc-slide"]:not(.karaco-sample-dom)');
    obj.arrange = new Array();
    obj.labels = new Array();
    for (let i = 0; i < obj.children.length; i++) {
      obj.children[i].style.display = 'none';
      let ord = obj.children[i].getAttribute('kc-ord');
      let name = obj.children[i].getAttribute('kc-label');
      if (!ord) {
        ord = i + 1;
        obj.children[i].setAttribute('kc-ord', ord);
      }
      obj.arrange[ord] = i;
      obj.labels[ord] = name;
    }
    obj.size = obj.children.length;
    obj.next = obj.parent.querySelectorAll('[kc-mode="kc-slider-next"]')[0];
    obj.prev = obj.parent.querySelectorAll('[kc-mode="kc-slider-prev"]')[0];
    obj.slideLabel = obj.parent.querySelectorAll('[kc-mode="kc-slider-label"]')[0] || null;
    obj.ee = new EventEmitter();
    obj.curSlide = 1;
    return obj;
  },

  updateSlide: function(){
    for (let i = 0; i < obj.children.length; i++) {
      obj.children[i].style.display = 'none';
      let ord = obj.children[i].getAttribute('kc-ord');
      let name = obj.children[i].getAttribute('kc-label');
      if (!ord) {
        ord = i + 1;
        obj.children[i].setAttribute('kc-ord', ord);
      }
      obj.arrange[ord] = i;
      obj.labels[ord] = name;
    }
  },

  initialize: function(){
    this.next.addEventListener('click', ()=>{this.nextSlide();});
    this.prev.addEventListener('click', ()=>{this.prevSlide();});
  },

  nextSlide: function(){
    this.curSlide++;
    if (this.curSlide > this.size) {
      if (this.loop) {
        this.curSlide = 1;
      } else {
        this.curSlide = this.size;
      }
    }
    this.ee.trigger('change-slide');
    this.update();
  },

  prevSlide: function(){
    this.curSlide--;
    if (this.curSlide < 1) {
      if (this.loop) {
        this.curSlide = this.size;
      } else {
        this.curSlide = 1;
      }
    }
    this.ee.trigger('change-slide');
    this.update();
  },

  update: function(){
    for (let i = 0; i < this.size; i++) {
      this.children[i].style.display = 'none';
    }
    if (this.size > 0) {
      this.children[this.arrange[this.curSlide]].style.display = 'block';
      if (this.slideLabel) {
        this.slideLabel.innerText = this.labels[this.curSlide];
      }
    }
  },

  goToSlide: function(s){
    this.curSlide = s;
    this.ee.trigger('change-slide');
    this.update();
  }
}


function findDivSlider(){
  let elms = document.querySelectorAll('[kc-mode="kc-slider"]');
  for (let i = 0; i < elms.length; i++) {
    let elm = elms[i];
    if (!elm.id) {
      elm.id = 'k-d-s-' + i;
    }
    kdsArray.push(DivSlider.create(elm.id));
  }

  for (let i = 0; i < kdsArray.length; i++) {
    kdsArray[i].initialize();
    kdsArray[i].update();
  }
}

findDivSlider();
const config = { attributes: true, childList: true, subtree: true };
const callback = function(mutationsList, observer) {
  for(const mutation of mutationsList) {
    if (mutation.target.getAttribute("kc-mode") === "kc-slider"){
      let elm = mutation.target;
      kdsArray.push(DivSlider.create(elm.id));
      kdsArray[kdsArray.length -1].initialize();
      kdsArray[kdsArray.length -1].update();
    }
  }
};
const observer = new MutationObserver(callback);
observer.observe(document, config);




// ********************* TABS **************************


var ktArray = new Array();
var KaracoTab = {
    create: function() {
        var obj = Object.create(this);
        for (var i = 0; i < arguments.length; i++) {
            var arg = arguments[i];
            if (checkType(arg) === 'String') {
              if (arg === 'LOOP') {
                obj.loop = true;
              } else {
                var id = arg;
              }
            }
        }
        obj.parent = document.getElementById(id);
        obj.tabHolder = obj.parent.querySelectorAll('[data-mode="kc-tab-tabs"]')[0];
        obj.btnHolder = obj.parent.querySelectorAll('[data-mode="kc-tab-btn"]')[0];
        obj.tabs = obj.tabHolder.querySelectorAll(':scope > div');
        obj.btns = obj.btnHolder.querySelectorAll('span');
        return obj;
    },

    initialize: function() {
        this.tabHolder.style.maxHeight = '70vh';
        this.tabHolder.style.overflowY = 'auto';
        this.btnHolder.style.marginBottom = '0';
        for (let i = 0; i < this.tabs.length; i++) {
            var tab = this.tabs[i];
            tab.style.display = "none";
        }

        for (let i = 0; i < this.btns.length; i++) {
            let btn = this.btns[i];
            btn.style.display = 'inline-block';
            btn.style.margin = '2px 1px';
            for (let j = 0; j < this.tabs.length; j++) {
                let tab = this.tabs[j];
                if (tab.id == btn.getAttribute('data-for')) {
                    btn.target = j;
                }
            }
            btn.addEventListener('click', ()=>{this.showTab(i);});
        }

        this.btns[0].classList.remove('bg-green-3', 'cl-white');
        this.btns[0].classList.add('bg-blue-7', 'cl-red-2');
        this.tabs[this.btns[0].target].style.display = "block";
        var id = this.btns[0].getAttribute('data-for');
        this.curTab = id;
    },

    showTab: function(i) {
        this.resetButtons();
        this.btns[i].classList.remove('bg-green-3', 'cl-white');
        this.btns[i].classList.add('bg-blue-7', 'cl-red-2');
        var id = this.btns[i].getAttribute('data-for');
        // $('#' + this.curTab).fadeOut(250, ()=>{$('#' + id).fadeIn(250);});
        this.curTab = id;
    },

    // hideTab: function() {
    //     $('#' + this.curTab).fadeOut(500);
    // },

    resetButtons: function(){
        for (let i = 0; i < this.btns.length; i++) {
            var btn = this.btns[i];
            btn.classList.remove('bg-blue-7', 'cl-red-2');
            btn.classList.add('bg-green-3', 'cl-white');
        }
    }
}

function findKaracoTabs(){
    var ktElms = document.querySelectorAll('[data-mode="karaco-tab"]');
    for (let i = 0; i < ktElms.length; i++) {
        var elm = ktElms[i];
        if (!elm.id) {
            elm.id = 'karaco-tab-' + String(Date.now()).shuffle();
        }
        ktArray.push(KaracoTab.create(elm.id));
    }

    for (let i = 0; i < ktArray.length; i++) {
        var kt = ktArray[i];
        kt.initialize();
    }
}

window.onload = function(){
    findKaracoTabs();
    findCals();
}



// *************** ANIMATIONS ******************



var KAnimation = {
	create: function(o){
		var obj = Object.create(this);
		obj.type = 'playSingle';
		if (checkType(o.target) == "String") {
		obj.target = document.getElementById(o.target);
		} else if (checkType(o.target) == "Dom") {
		obj.target = o.target;
		} else {
		obj.target = o.target;
		obj.type = 'playMulti';
		}
		obj.interVal = o.interVal || 0;
		obj.duration = o.duration || 500;
		obj.ease = o.ease || 'linear';
		obj.props = o.props;
		obj.delay = o.delay || 0;
		return obj;
	},

	play: function(){
		this[this.type]();
	},

	playMulti: function() {
		for (let j = 0; j < this.target.length; j++) {
			var elm = this.target[j];
			console.log(elm);
		}
	},

	playSingle: function(){
		for (var i = 0; i < this.props.length; i++) {
			var p = this.props[i];
			var f, b, blur = 0;
			
			setTimeout(()=>{
				var fil = window.getComputedStyle(this.target).getPropertyValue('filter');
				if (fil == 'none') {
					var filv = 0;
				} else {
					var filt = fil.split('(')[0];
					var filv = fil.split('(')[1];
					filv = parseFloat(filv.split(')')[0]);
				}
				var m = window.getComputedStyle(this.target).getPropertyValue('transform');
				if (m == 'none') {
					m = 'matrix(1,0,0,1,0,0)';
					this.target.style.transform = m;
				}
				var mt = m.split('(')[1];
				mt = mt.split(')')[0];
				mt = mt.split(',');
				switch (p[0]) {
					case 'skewX':
						b = parseFloat(mt[1]);
						f = '';
						break;
					case 'skewY':
						b = parseFloat(mt[2]);
						f = '';
						break;
					case 'scaleX':
						b = parseFloat(mt[0]);
						f = '';
						break;
					case 'scaleY':
						b = parseFloat(mt[3]);
						f = '';
						break;
					case 'translateX':
						b = parseFloat(mt[4]);
						f = '';
						break;
					case 'translateY':
						b = parseFloat(mt[5]);
						f = '';
						break;
					case 'blur':
						b = filv;
						f = '';
						break;
					case 'opacity':
						b = parseFloat(window.getComputedStyle(this.target).getPropertyValue(p[0]));
						f = '';
						break;
				
					default:
						b = parseFloat(window.getComputedStyle(this.target).getPropertyValue(p[0]));
						f = 'px';
						break;
				}
				var c = p[1] - b;
				var s = Date.now();
				this.animate(s, p, b, c, f);
			}, this.delay);
		}
	},

	animate: function(s, p, b, c, f){
		var et = Date.now() - s;
		if (et < this.duration) {
			var m = window.getComputedStyle(this.target).getPropertyValue('transform');
			var mt = m.split('(')[1];
			mt = mt.split(')')[0];
			mt = mt.split(',');
			var l = window[this.ease](et, b, c, this.duration);
			switch (p[0]) {
				case 'skewX':
					this.target.style.transform = 'matrix(' + mt[0] + ', ' + l + ', ' + mt[2] + ', ' + mt[3] + ', ' + mt[4] + ', ' + mt[5] + ')';
					break;
				case 'skewY':
					this.target.style.transform = 'matrix(' + mt[0] + ', ' + mt[1] + ', ' + l + ', ' + mt[3] + ', ' + mt[4] + ', ' + mt[5] + ')';
					break;
				case 'scaleX':
					this.target.style.transform = 'matrix(' + l + ', ' + mt[1] + ', ' + mt[2] + ', ' + mt[3] + ', ' + mt[4] + ', ' + mt[5] + ')';
					break;
				case 'scaleY':
					this.target.style.transform = 'matrix(' + mt[0] + ', ' + mt[1] + ', ' + mt[2] + ', ' + l + ', ' + mt[4] + ', ' + mt[5] + ')';
					break;
				case 'tanslateX':
					this.target.style.transform = 'matrix(' + mt[0] + ', ' + mt[1] + ', ' + mt[2] + ', ' + mt[3] + ', ' + l + ', ' + mt[5] + ')';
					break;
				case 'translateY':
					this.target.style.transform = 'matrix(' + mt[0] + ', ' + mt[1] + ', ' + mt[2] + ', ' + mt[3] + ', ' + mt[4] + ', ' + l + ')';
					break;
				case 'blur':
					console.log();
					this.target.style.filter = 'blur(' + l + 'px)';
					break;
			
				default:
					this.target.style[p[0]] = l + f;
					break;
			}
			requestAnimationFrame(()=>{
				this.animate(s, p, b, c, f);
			});
		} else {
		this.target.style[p[0]] = p[1] + f;
		}
	}
}


// ********************* EASING *******************


function linear(t, b, c, d) {
  return c * t / d + b;
}
function easeInQuad(t, b, c, d) {
  return c*(t/=d)*t + b;
}
function easeOutQuad(t, b, c, d) {
  return -c *(t/=d)*(t-2) + b;
}
function easeInOutQuad(t, b, c, d) {
  if ((t/=d/2) < 1) return c/2*t*t + b;
  return -c/2 * ((--t)*(t-2) - 1) + b;
}
function easeInCubic(t, b, c, d) {
  return c*(t/=d)*t*t + b;
}
function easeOutCubic(t, b, c, d) {
  return c*((t=t/d-1)*t*t + 1) + b;
}
function easeInOutCubic(t, b, c, d) {
  if ((t/=d/2) < 1) return c/2*t*t*t + b;
  return c/2*((t-=2)*t*t + 2) + b;
}
function easeInQuart(t, b, c, d) {
  return c*(t/=d)*t*t*t + b;
}
function easeOutQuart(t, b, c, d) {
  return -c * ((t=t/d-1)*t*t*t - 1) + b;
}
function easeInOutQuart(t, b, c, d) {
  if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
  return -c/2 * ((t-=2)*t*t*t - 2) + b;
}
function easeInQuint(t, b, c, d) {
  return c*(t/=d)*t*t*t*t + b;
}
function easeOutQuint(t, b, c, d) {
  return c*((t=t/d-1)*t*t*t*t + 1) + b;
}
function easeInOutQuint(t, b, c, d) {
  if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
  return c/2*((t-=2)*t*t*t*t + 2) + b;
}
function easeInSine(t, b, c, d) {
  return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
}
function easeOutSine(t, b, c, d) {
  return c * Math.sin(t/d * (Math.PI/2)) + b;
}
function easeInOutSine(t, b, c, d) {
  return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
}
function easeInExpo(t, b, c, d) {
  return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
}
function easeOutExpo(t, b, c, d) {
  return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
}
function easeInOutExpo(t, b, c, d) {
  if (t==0) return b;
  if (t==d) return b+c;
  if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
  return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
}
function easeInCirc(t, b, c, d) {
  return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
}
function easeOutCirc(t, b, c, d) {
  return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
}
function easeInOutCirc(t, b, c, d) {
  if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
  return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
}
function easeInElastic(t, b, c, d) {
  var s=1.70158;var p=0;var a=c;
  if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
  if (a < Math.abs(c)) { a=c; var s=p/4; }
  else var s = p/(2*Math.PI) * Math.asin (c/a);
  return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
}
function easeOutElastic(t, b, c, d) {
  var s=1.70158;var p=0;var a=c;
  if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
  if (a < Math.abs(c)) { a=c; var s=p/4; }
  else var s = p/(2*Math.PI) * Math.asin (c/a);
  return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
}
function easeInOutElastic(t, b, c, d) {
  var s=1.70158;var p=0;var a=c;
  if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
  if (a < Math.abs(c)) { a=c; var s=p/4; }
  else var s = p/(2*Math.PI) * Math.asin (c/a);
  if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
  return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
}
function easeInBack(t, b, c, d, s) {
  if (s == undefined) s = 1.70158;
  return c*(t/=d)*t*((s+1)*t - s) + b;
}
function easeOutBack(t, b, c, d, s) {
  if (s == undefined) s = 1.70158;
  return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
}
function easeInOutBack(t, b, c, d, s) {
  if (s == undefined) s = 1.70158;
  if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
  return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
}
function easeInBounce(t, b, c, d) {
  return c - easeOutBounce(d-t, 0, c, d) + b;
}
function easeOutBounce(t, b, c, d) {
  if ((t/=d) < (1/2.75)) {
      return c*(7.5625*t*t) + b;
  } else if (t < (2/2.75)) {
      return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
  } else if (t < (2.5/2.75)) {
      return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
  } else {
      return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
  }
}
function easeInOutBounce(t, b, c, d) {
  if (t < d/2) return easeInBounce (t*2, 0, c, d) * .5 + b;
  return easeOutBounce(t*2-d, 0, c, d) * .5 + c*.5 + b;
}



// ***************** LOADING ******************

class Loading {
  constructor(o) {
      this.image = o.image || 'none';
      this.video = o.video || 'none';
      this.images = [];
      this.videos = [];
      this.callback = o.callback || null;
      this.loadedImg = 0;
      this.loadedVid = 0;
      this.forceTime = o.forceTime || 120000;
      this.showPercent = o.showPercent || false;
      this.complete = false;
      if (this.showPercent) {
          this.target = document.getElementById(o.target);
      }
  }

  checkImage(url) {
    var request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.send();
    request.onload = function() {
      status = request.status;
      if (request.status == 200) //if(statusText == OK)
      {
        return true;
      } else {
        return false;
      }
    }
  }

  init() {
      if (this.image === 'all') {
          this.images = document.querySelectorAll('img:not([loading="lazy"])');
      }

      if (this.video === 'all') {
          this.videos = document.querySelectorAll('video');
      }

      this.imgCount = this.images.length;
      this.vidCount = this.videos.length;

      this.images.forEach((el, ix) => {
          if (!this.checkImage(el.src)) {
            this.loadedImg++;
            this.update();
          } else {
            if (el.complete && el.naturalHeight !== 0) {
              this.loadedImg++;
              this.update();
            } else {
                el.addEventListener("load", ()=> {
                    this.loadedImg++;
                    this.update();
                })
            }
          }          

          el.addEventListener("error", ()=> {
              this.imgCount--;
              this.update();
          })

          if (this.callback) {
              this.force();
          }
      })

      this.videos.forEach((el, ix) => {
          if (el.readystate === 4) {
              this.loadedVid++;
              this.update();
          } else {
              el.addEventListener('canplaythrough', ()=> {
                  this.loadedVid++;
                  this.update();
              })
          }
      })
  }

  update() {
      if (this.complete) return;
      if (this.showPercent) {
          this.target.innerText = ((this.loadedImg + this.loadedVid) / (this.imgCount + this.vidCount) * 100).toFixed(1) + "%";
      }
      if (this.imgCount === this.loadedImg && this.vidCount === this.loadedVid) {
          if (this.callback) {
              this.callback();
              this.callback = null;
          }
          this.complete = true;
      }
  }

  force() {
      setTimeout(()=>{
          this.target.innerText = '100%';
          if (this.callback) {
              this.callback();
              this.callback = null;
          }
      }, this.forceTime);
  }
}


// ****************** TEXT TRANSITION *********************

class TextTransition {
  constructor(tg, p1, p2, p3, lang) {
      if (checkType(tg) === 'String') {
          this.target = document.getElementById(tg);
      } else {
          this.target = tg;
      }
      this.children = [];
      this.p1 = p1 * 1000 || 1000;
      this.p2 = p2 * 1000 || 1000;
      this.p3 = p3 * 1000 || 1000;
      this.sTime = 0;
      this.lang = lang || 'en';
  }

  reset() {
      this.target.innerHTML = initial.querySelectorAll('[kc-key="'+this.target.getAttribute('kc-key')+'"]')[0].innerHTML;
      // for (let j = 0; j < this.children.length; j++) {
      //     const child = this.children[j];
      //     child.innerText = child.chars.join('');
      //     // child.dir = 'forward';
      //     // child.maxLength = 0;
      //     // child.startPos = 0;
      // }
  }

  init() {
      let allowed = ['H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'SPAN', 'P', 'A'];
      let arr = this.target.getAllChildren();
      for (let i = 0; i < arr.length; i++) {
          let elm = arr[i];
          if (allowed.includes(elm.tagName)) {
              this.children.push(new Chars(elm, this.p1, this.p2, this.p3, this.lang));
          }
      }

      for (let j = 0; j < this.children.length; j++) {
          const child = this.children[j];
          child.init();
      }
  }

  setP(p1, p2, p3) {
      this.p1 = p1 * 1000 || 1000;
      this.p2 = p2 * 1000 || 1000;
      this.p3 = p3 * 1000 || 1000;
      for (let j = 0; j < this.children.length; j++) {
          const child = this.children[j];
          child.setP(this.p1, this.p2, this.p3);
      }
  }
  
  update() {
      for (let i = 0; i < this.children.length; i++) {
          const child = this.children[i];
          if (child.dir != 'stop') {
              child.update(this.sTime);
          }
      }
  }

  start() {
      this.sTime = Date.now();
      this.animate();
  }
  
  animate() {
      this.update();
      requestAnimationFrame(() => {
          this.animate();
      });
  }
}

class Chars {
  constructor(elm, p1, p2, p3, lang) {
      this.elm = elm;
      this.maxLength = 1;
      this.chars = [];
      this.source = "";
      this.startPos = 0;
      this.dir = 'forward';
      this.p1 = p1;
      this.p2 = p2;
      this.p3 = p3;
      this.lang = lang;
  }

  init() {
      let str = this.elm.innerText;
      this.chars = Array.from(str);
      this.source = this.getSource();
  }

  setP(p1, p2, p3) {
      this.p1 = p1;
      this.p2 = p2;
      this.p3 = p3;
  }

  getSource() {
      if (this.lang === 'fa') {
          return "اآبپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی0123456789$%@*&',";
      } else if (this.lang === 'de') {
          return "AÄBCDEFGHIJKLMNOÖPQRSßTUÜVWXYZaäbcdefghijklmnoöpqrstuüvwxyz0123456789$%@*&',";
      } else {
          return "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$%@*&',";
      }
  }

  update(t0) {
      if (this.dir != 'stop') {
          let t1 = Date.now();
          if (this.dir === 'forward') {
              let dt = t1 - t0;
              if (dt > this.p1) {
                  this.maxLength = this.chars.length;
                  this.dir = 'still';
              } else {
                  let dl = Math.round(easeInOutSine(dt, 0, this.chars.length, this.p1));
                  this.maxLength = dl;
              }
          } else if (this.dir === 'still') {
              let dt = t1 - t0 - this.p1;
              if (dt > this.p2) {
                  this.dir = 'backward';
              }
          } else if (this.dir === 'backward') {
              let dt = t1 - t0 - (this.p1 + this.p2);
              if (dt > this.p3) {
                  this.startPos = this.chars.length - 1;
                  this.dir = 'stop';
              } else {
                  let ds = Math.round(easeInOutSine(dt, 0, this.chars.length, this.p3));
                  // console.log(ds);
                  this.startPos = ds;
              }
          }

          // console.log(this.dir, this.startPos);
          for (let i = this.startPos; i < this.maxLength; i++) {
              let c = this.source[Math.floor(Math.random() * this.source.length)];
              this.elm.innerText = this.elm.innerText.replaceAt(i, c);
          }

          if (this.startPos < this.chars.length) {
              this.elm.innerText = this.elm.innerText.replaceFromTo(0, this.startPos, this.chars.join('').substr(0, this.startPos+1));
          }
      }        
  }
}

const initial = document.body.cloneNode(true);


// ******************** PAGE SLIDER *********************

class PageSlider {
  constructor(o) {
      if (checkType(o.target) == 'String') {
          this.target = document.getElementById(o.target);
      } else {
          this.target = document.target;
      }

      this.children = this.target.querySelectorAll('[kc-mode="slide"]');
      this.nextBtn = document.createElement('div');
      this.prevBtn = document.createElement('div');

      this.cs = 0;
      this.os = 0;
      this.max = this.children.length - 1;
      this.dir = o.dir || 'ltr';
  }

  init() {
      this.target.style.width = '100%';
      this.target.style.height = '90vh';
      this.target.style.paddingBottom = '10vh';
      this.target.style.overflow = 'hidden';
      this.target.style.position = 'relative';
      this.nextBtn.style.position = 'fixed';
      this.prevBtn.style.position = 'fixed';
      this.nextBtn.style.top = '0';
      this.prevBtn.style.top = '0';
      this.nextBtn.style.width = '100px';
      this.prevBtn.style.width = '100px';
      this.nextBtn.style.maxWidth = '6%';
      this.prevBtn.style.maxWidth = '6%';
      this.nextBtn.style.height = '90vh';
      this.prevBtn.style.height = '90vh';
      this.xDown = null;
      this.yDown = null;
      this.xUp = null;
      this.yUp = null;
      this.xDiff = null;
      this.yDiff = null;
      this.startX = null;
      this.startY = null;
      this.isDrag = false;
      this.updown = null;
      this.leftValues = [];
      this.topValues = [];
      this.target.style.cursor = 'grab';
      this[this.dir]();

      this.nextBtn.addEventListener('click', ()=>{this.next();});
      this.prevBtn.addEventListener('click', ()=>{this.prev();});

      this.target.addEventListener('touchmove', (e)=>{
          if ( ! this.xDown || ! this.yDown ) {
              return;
          }
      
          this.xUp = e.touches[0].clientX;
          this.yUp = e.touches[0].clientY;
      
          this.xDiff = this.xDown - this.xUp;
          this.yDiff = this.yDown - this.yUp;
      
          if ( Math.abs( this.xDiff ) > Math.abs( this.yDiff ) ) {
              if (this.dir === 'ltr') {
                  if ( this.xDiff > 0 ) {
                      this.next();
                  } else {
                      this.prev();
                  }  
              } else {
                  if ( this.xDiff < 0 ) {
                      this.next();
                  } else {
                      this.prev();
                  }  
              }
                                   
          } else {
              if ( this.yDiff > 0 ) {
                  this.slideUp(Math.abs(20 * this.yDiff));
              } else {
                  this.slideDown(Math.abs(20 * this.yDiff));
              }                                                                 
          }
          
          
          this.xDown = null;
          this.yDown = null;

      }, {passive: true});

      this.target.addEventListener('touchstart', (e)=>{
          const firstTouch = getTouches(e)[0]; 
          this.xDown = firstTouch.clientX;
          this.yDown = firstTouch.clientY;
      }, {passive: true})

      this.target.addEventListener('mousedown', (e) => {
          if (this.isDrag) return;
          this.target.style.cursor = 'grabbing';
          this.isDrag = true;
          this.startX = e.pageX;
          this.startY = e.pageY;
          this.children.forEach((el, ix) => {
              this.leftValues[ix] = parseInt(el.style.left);
              this.topValues[ix] = parseInt(el.style.top);
          });
      })

      this.target.addEventListener('mouseup', (e) => {
          this.isDrag = false;
          this.target.style.cursor = 'grab';
          this.startX = null;
          this.startY = null;
          this.updown = null;
          this.update();
          this.children.forEach((el, ix) => {
              el.style.pointerEvents = 'all';    
          })

          if (parseInt(this.children[this.cs].style.top) < -this.children[this.cs].clientHeight + 0.5 * window.innerHeight) {
              this.children[this.cs].style.top = (0.5 * window.innerHeight - this.children[this.cs].clientHeight) + 'px';
          }

          if (parseInt(this.children[this.cs].style.top) > 0) {
              this.children[this.cs].style.top = 0;
          }
      })

      this.target.addEventListener('mouseleave', (e) => {
          this.isDrag = false;
          this.target.style.cursor = 'grab';
          this.startX = null;
          this.startY = null;
          this.updown = null;
          this.update();
          this.children.forEach((el, ix) => {
              el.style.pointerEvents = 'all';    
          })

          if (parseInt(this.children[this.cs].style.top) < -this.children[this.cs].clientHeight + 0.5 * window.innerHeight) {
              this.children[this.cs].style.top = (0.5 * window.innerHeight - this.children[this.cs].clientHeight) + 'px';
          }

          if (parseInt(this.children[this.cs].style.top) > 0) {
              this.children[this.cs].style.top = 0;
          }
      })

      this.target.addEventListener('mousemove', (e) => {
          e.preventDefault();
          if (!this.isDrag) return;
          let xd = this.startX - e.pageX;
          let yd = this.startY - e.pageY;
          this.children.forEach((el, ix) => {
              el.style.pointerEvents = 'none';    
          })

          if (this.updown === null) {
              if (Math.abs(xd) > Math.abs(yd)) {
                  this.updown = false;
              } else {
                  this.updown = true;
              }
          }

          if (this.updown === false) {
              this.children.forEach((el, ix) => {
                  if (this.dir === 'ltr') {
                      el.style.left = (this.leftValues[ix] - (xd / window.innerWidth * 250)) + '%';
                  } else {
                      el.style.right = (this.leftValues[ix] - (xd / window.innerWidth * 250)) + '%';
                  }
                  
              });
              if (this.dir === 'ltr') {
                  if (xd > 200) {
                      this.isDrag = false;
                      this.next();
                      return;
                  }
      
                  if (xd < -200) {
                      this.isDrag = false;
                      this.prev();
                      return;
                  }
              } else {
                  if (xd > 200) {
                      this.isDrag = false;
                      this.prev();
                      return;
                  }
      
                  if (xd < -200) {
                      this.isDrag = false;
                      this.next();
                      return;
                  }
              }
              
          } else if (this.updown === true) {
              this.children[this.cs].style.top = (this.topValues[this.cs] - 3*yd) + 'px';

              if (yd > 150) {
                  this.isDrag = false;
                  this.slideUp(200);
                  return;
              } else if (yd < -150) {
                  this.isDrag = false;
                  this.slideDown(200);
                  return;
              }
          }
          
          
      })

      document.body.appendChild(this.nextBtn);
      document.body.appendChild(this.prevBtn);

      this.children.forEach((el, ix) => {
          el.style.width = '88%';
          el.style.maxWidth = '1000px';
          el.style.position = 'absolute';
          el.style.display = 'block';
          el.style.transition = 'all ease 0.5s';
          el.style.top = 0;
      });

      this.target.addEventListener('wheel', (e) => {
          if (e.deltaY === 125) {
              this.slideUp(125);
          } else if (e.deltaY === -125) {
              this.slideDown(125);
          }
      })
  }

  ltr() {
      this.nextBtn.style.right = '0';
      this.prevBtn.style.left = '0';
      this.nextBtn.style.cursor = 'url("data:image/svg+xml,%3C%3Fxml version=\'1.0\' encoding=\'utf-8\'%3F%3E%3Csvg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'48px\' height=\'48px\' viewBox=\'0 0 128 128\' style=\'enable-background:new 0 0 128 128;\' xml:space=\'preserve\'%3E%3Cg%3E%3Cpath d=\'M64,64.7c0,1.3-0.4,2.6-1.1,3.5l-32,48c-1.2,1.7-3.1,2.9-5.3,2.9H6.4c-3.5,0-6.4-2.9-6.4-6.4c0-1.3,0.4-2.6,1.1-3.5 l29.6-44.5L1.1,20.2c-0.7-1-1.1-2.2-1.1-3.5c0-3.5,2.9-6.4,6.4-6.4h19.2c2.2,0,4.2,1.2,5.3,2.9l32,48C63.6,62.1,64,63.4,64,64.7z\' /%3E%3Cpath d=\'M128,64.7c0,1.3-0.4,2.6-1.1,3.5l-32,48c-1.2,1.7-3.1,2.9-5.3,2.9H70.4c-3.5,0-6.4-2.9-6.4-6.4c0-1.3,0.4-2.6,1.1-3.5 l29.6-44.5L65.1,20.2c-0.7-1-1.1-2.2-1.1-3.5c0-3.5,2.9-6.4,6.4-6.4h19.2c2.2,0,4.2,1.2,5.3,2.9l32,48 C127.6,62.1,128,63.4,128,64.7z\'/%3E%3C/g%3E%3C/svg%3E%0A") 16 16, pointer';
      this.prevBtn.style.cursor = 'url("data:image/svg+xml,%3C%3Fxml version=\'1.0\' encoding=\'utf-8\'%3F%3E%3Csvg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'48px\' height=\'48px\' viewBox=\'0 0 128 128\' style=\'enable-background:new 0 0 128 128;\' xml:space=\'preserve\'%3E%3Cg%3E%3Cpath d=\'M64,64.6c0-1.3,0.4-2.6,1.1-3.5l32-48c1.1-1.7,3.1-2.9,5.3-2.9h19.2c3.5,0,6.4,2.9,6.4,6.4c0,1.3-0.4,2.6-1.1,3.5 L97.3,64.6l29.6,44.5c0.7,1,1.1,2.3,1.1,3.5c0,3.5-2.9,6.4-6.4,6.4h-19.2c-2.3,0-4.1-1.1-5.3-2.9l-32-48C64.4,67.2,64,65.9,64,64.6 z\'/%3E%3Cpath d=\'M0,64.6c0-1.3,0.4-2.6,1.1-3.5l32-48c1.1-1.7,3.1-2.9,5.3-2.9h19.2c3.5,0,6.4,2.9,6.4,6.4c0,1.3-0.4,2.6-1.1,3.5L33.3,64.6 l29.6,44.5c0.7,1,1.1,2.3,1.1,3.5c0,3.5-2.9,6.4-6.4,6.4H38.4c-2.3,0-4.1-1.1-5.3-2.9l-32-48C0.4,67.2,0,65.9,0,64.6z\'/%3E%3C/g%3E%3C/svg%3E%0A") 16 16, pointer';
  }

  rtl() {
      this.prevBtn.style.right = '0';
      this.nextBtn.style.left = '0';
      this.prevBtn.style.cursor = 'url("data:image/svg+xml,%3C%3Fxml version=\'1.0\' encoding=\'utf-8\'%3F%3E%3Csvg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'48px\' height=\'48px\' viewBox=\'0 0 128 128\' style=\'enable-background:new 0 0 128 128;\' xml:space=\'preserve\'%3E%3Cg%3E%3Cpath d=\'M64,64.7c0,1.3-0.4,2.6-1.1,3.5l-32,48c-1.2,1.7-3.1,2.9-5.3,2.9H6.4c-3.5,0-6.4-2.9-6.4-6.4c0-1.3,0.4-2.6,1.1-3.5 l29.6-44.5L1.1,20.2c-0.7-1-1.1-2.2-1.1-3.5c0-3.5,2.9-6.4,6.4-6.4h19.2c2.2,0,4.2,1.2,5.3,2.9l32,48C63.6,62.1,64,63.4,64,64.7z\' /%3E%3Cpath d=\'M128,64.7c0,1.3-0.4,2.6-1.1,3.5l-32,48c-1.2,1.7-3.1,2.9-5.3,2.9H70.4c-3.5,0-6.4-2.9-6.4-6.4c0-1.3,0.4-2.6,1.1-3.5 l29.6-44.5L65.1,20.2c-0.7-1-1.1-2.2-1.1-3.5c0-3.5,2.9-6.4,6.4-6.4h19.2c2.2,0,4.2,1.2,5.3,2.9l32,48 C127.6,62.1,128,63.4,128,64.7z\'/%3E%3C/g%3E%3C/svg%3E%0A") 16 16, pointer';
      this.nextBtn.style.cursor = 'url("data:image/svg+xml,%3C%3Fxml version=\'1.0\' encoding=\'utf-8\'%3F%3E%3Csvg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'48px\' height=\'48px\' viewBox=\'0 0 128 128\' style=\'enable-background:new 0 0 128 128;\' xml:space=\'preserve\'%3E%3Cg%3E%3Cpath d=\'M64,64.6c0-1.3,0.4-2.6,1.1-3.5l32-48c1.1-1.7,3.1-2.9,5.3-2.9h19.2c3.5,0,6.4,2.9,6.4,6.4c0,1.3-0.4,2.6-1.1,3.5 L97.3,64.6l29.6,44.5c0.7,1,1.1,2.3,1.1,3.5c0,3.5-2.9,6.4-6.4,6.4h-19.2c-2.3,0-4.1-1.1-5.3-2.9l-32-48C64.4,67.2,64,65.9,64,64.6 z\'/%3E%3Cpath d=\'M0,64.6c0-1.3,0.4-2.6,1.1-3.5l32-48c1.1-1.7,3.1-2.9,5.3-2.9h19.2c3.5,0,6.4,2.9,6.4,6.4c0,1.3-0.4,2.6-1.1,3.5L33.3,64.6 l29.6,44.5c0.7,1,1.1,2.3,1.1,3.5c0,3.5-2.9,6.4-6.4,6.4H38.4c-2.3,0-4.1-1.1-5.3-2.9l-32-48C0.4,67.2,0,65.9,0,64.6z\'/%3E%3C/g%3E%3C/svg%3E%0A") 16 16, pointer';
  }

  update() {
      this.children.forEach((el, ix) => {
          if (this.dir === 'ltr') {
              el.style.left = (((ix - this.cs) * 88)+3) + '%';
          } else {
              el.style.right = (((ix - this.cs) * 88)+3) + '%';
          }
          
      });
      this.target.scrollTop = 0;
  }

  slideUp(d) {
      this.children[this.cs].style.top = (parseInt(this.children[this.cs].style.top) - d) + 'px';
      if (parseInt(this.children[this.cs].style.top) < -this.children[this.cs].clientHeight + 0.5 * window.innerHeight) {
          this.children[this.cs].style.top = (0.5 * window.innerHeight - this.children[this.cs].clientHeight) + 'px';
      }
  }

  slideDown(d) {
      this.children[this.cs].style.top = (parseInt(this.children[this.cs].style.top) + d) + 'px';
      if (parseInt(this.children[this.cs].style.top) > 0) {
          this.children[this.cs].style.top = 0;
      }
  }

  next() {
      this.os = this.cs;
      this.cs++;
      if (this.cs > this.max) {
          this.cs = this.max;
      }
      this.update();
  }

  prev() {
      this.os = this.cs;
      this.cs--;
      if (this.cs < 0) {
          this.cs = 0;
      }
      this.update();
  }
}

function getTouches(evt) {
  return evt.touches ||             // browser API
         evt.originalEvent.touches; // jQuery
}



// *********************** POPUPS ********************

function popup(o){
  this.initialize(o);
  this.draw[this.type].call(this);

  if (this.isYesNo) {
    this.yesno();
  } else if (this.isOK) {
    this.ok();
  }

  this.showIt();
}

popup.prototype.initialize = function(o){
  this.type = o.type;
  this.id = o.id;
  this.timerColor = o.cl || 'bg-red-3';
  this.isYesNo = o.isYesNo || false;
  this.dir = o.dir || 'ltr';
  if (o.target) {
    let tmp = document.getElementById(o.target).cloneNode(true);
    let children = tmp.querySelectorAll('*');
    children.forEach((elm)=>{
      if (elm.id.length > 0) {
        elm.id = elm.id + '-pop';
      }
    })
    tmp.id = tmp.id + '-popup';
    tmp.classList.remove('popup');
    this.msg = tmp;
  } else {
    this.msg = o.msg;
  }

  this.cb = o.cb || null;

  this.size = o.size || 'md';
  
  if (o.isOK) {
    this.isOK = o.isOK;
    this.okText = o.okText;
  }

  this.overal = document.createElement('div');
  this.overal.className = 'overal';

  if (o.onExit) {
    this.onExit = o.onExit;
  }

  this.timer = o.timer || 3200;

  this.parentDiv = document.createElement('div');
  this.parentDiv.id = this.id;
  this.parentDiv.className = 'popup-holder pd-b-70';
  this.parentDiv.setAttribute('tabindex', 0);
  this.containerDiv = document.createElement('div');
  this.containerDiv.id = this.id + '-popup';
  this.containerDiv.className = 'popup-container bg-grey-1 txt-c cl-black ' + this.size;
  this.containerDiv.style.direction = this.dir;

  document.body.appendChild(this.parentDiv);
  this.parentDiv.addEventListener('keydown', (e)=>{
    if (e.code == 'Escape') {this.exit();}
  })
  if (this.isYesNo) {
    this.yesFunction = o.yesFunction;
  } else if (this.isOK) {
    this.okFunction = o.okFunction;
  }

}

popup.prototype.draw = new Array();

popup.prototype.draw.fly = function(){
  this.parentDiv.appendChild(this.overal);
  this.parentDiv.appendChild(this.containerDiv);
  this.containerDiv.innerHTML = "";
  this.overal.onclick = this.exit.bind(this);
  this.containerDiv.append(this.msg);
}

popup.prototype.draw.steady = function(){
  this.parentDiv.appendChild(this.overal);
  this.parentDiv.appendChild(this.containerDiv);
  this.containerDiv.innerHTML = "";
  this.exitbtn = document.createElement('span');
  this.exitbtn.classList.add('exit', 'bg-grey-7', 'cl-light', 'pos-a');
  this.exitbtn.innerHTML = '<strong>X</strong>';
  this.exitbtn.style.left = '10px';
  this.exitbtn.style.top = '10px';
  this.exitbtn.onclick = this.exit.bind(this);
  this.overal.onclick = "";

  this.containerDiv.appendChild(this.exitbtn);
  this.containerDiv.append(this.msg);
}

popup.prototype.draw.timer = function(){
  this.timerDiv = document.createElement('div');
  this.timerDiv.style.position = 'absolute';
  this.timerDiv.style.top = '20px';
  this.timerDiv.style.transform = 'translateX(-50%)';
  this.timerDiv.style.left = '50%';
  this.timerDiv.style.display = 'none';
  this.timerDiv.className = 'p-x-3 p-y-1 brr-1 cl-white ' + this.timerColor;
  this.timerDiv.innerHTML = "";
  this.overal.style.height = 0;
  this.parentDiv.style.height = 0;
  this.timerDiv.append(this.msg);
  this.parentDiv.appendChild(this.timerDiv);
  this.parentDiv.style.pointerEvents = 'none';


}

popup.prototype.exit = function(){
  if (this.onExit) {
    this.onExit();
  }
  this.parentDiv.classList.remove('show');
  setTimeout(()=>{
    document.body.removeChild(this.parentDiv);
    this.parentDiv.innerHTML = "";
    document.body.style.overflowY = 'auto';
  }, 250)
}

popup.prototype.yesno = function(){
  this.yesnoholder = document.createElement('div');
  this.yesbtn = document.createElement('button');
  this.nobtn = document.createElement('button');
  this.yesbtn.innerHTML = 'yes';
  this.nobtn.innerHTML = 'no';
  this.yesbtn.classList.add('yes-btn');
  this.nobtn.classList.add('no-btn');

  this.yesbtn.onclick = this.yesAction.bind(this);
  this.nobtn.onclick = this.exit.bind(this);

  this.yesnoholder.appendChild(this.yesbtn);
  this.yesnoholder.appendChild(this.nobtn);
  this.containerDiv.appendChild(this.yesnoholder);
}

popup.prototype.ok = function(){
  this.okholder = document.createElement('div');
  this.okbtn = document.createElement('button');
  this.okbtn.innerHTML = this.okText;
  this.okbtn.classList.add('cl-white', 'bg-cyan-3', 'hvr-blue', 'pd-10', 'round-input', 'clickable', 'bx-shdw-2', 'mg-l-5', 'mg-r-5', 'mg-t-20');
  this.okbtn.style.width = '100px';

  this.okbtn.onclick = this.okAction.bind(this);

  this.okholder.appendChild(this.okbtn);
  this.containerDiv.appendChild(this.okholder);
}

popup.prototype.yesAction = function(){
  this.exit();
  this.yesFunction();
}

popup.prototype.okAction = function(){
  this.okFunction();
  this.exit();
}

popup.prototype.showIt = function(){
  if (this.type == 'timer') {
    this.timerDiv.style.display = 'block';
    setTimeout(()=>{
      this.timerDiv.style.display = 'none';
      this.parentDiv.removeChild(this.timerDiv);
      this.exit();
    }, this.timer);
  }
  document.body.style.overflowY = 'hidden';
  // document.body.style.marginRight = '8px';
  setTimeout(()=>{
    this.parentDiv.classList.add('show');
    if (this.cb) {
      this.cb();
    }
    if (this.type != 'timer') {
      setTimeout(()=>{this.parentDiv.focus();}, 100)
    }
  }, 200)
}

function innerErr(err, dir, title){
  var div = document.createElement('div');
  div.style.textAlign = dir;
  div.innerHTML = '<h1 style="color:#FD685D">'+title+'</h1>';
  for (var i = 0; i < err.length; i++) {
    var s = document.createElement('span');
    s.style.display = 'block';
    s.style.color = '#333';
    s.innerHTML = (i+1) + ' - ' + err[i];

    div.appendChild(s);
  }
  var msgpop = new popup({id:'msgpop', msg:div, type:'fly'});
}

function handleErr(data, callback, cb, not, dir, title, typ){
  if (!typ) typ = 'fly';
  if (!dir) dir = 'left';
  if (!title) title = 'Warning';
  cb = cb || null;
  if (data.res == 2) {
    innerErr(data.err, dir, title);
  } else if (data.res == 1) {
    if (!not) {
      fastMsg(data.msg, cb, typ, data.res);
    }
    if (typeof callback == 'function') {
      callback();
    }
  } else {
    fastMsg(data.msg, cb, typ, data.res);
  }
}

function fastMsg(msg, cb, typ, res) {
  let cl;
  if (!typ) typ = 'steady';
  res === 1 ? cl = 'bg-green-6' : cl = 'bg-red-3';
  let msgpop = new popup({
    id: 'msgpop',
    msg: msg,
    type: typ,
    onExit: cb,
    cl:cl
  });
}



// ******************** WAVES ***********************

const wavesP = [];

const waveParent = {
    create: function(o) {
        let obj = Object.create(this);
        obj.target = o.target;
        obj.can = document.getElementById(o.target);
        obj.ctx = obj.can.getContext('2d');
        obj.bw = o.bw || 1000;
        obj.bh = o.bh || 700;
        obj.can.width = obj.bw;
        obj.can.height = obj.bh;
        obj.waves = [];
        return obj;
    },

    reset: function() {
        this.can = document.getElementById(this.target);
        this.ctx = this.can.getContext('2d');
        this.can.width = this.bw;
        this.can.height = this.bh;
    },

    add: function(o) {
        this.waves.push(wave.create({bw:this.bw, bh:this.bh, ox:o.ox, oy:o.oy, of:o.of, y:o.y, r:o.r, d:o.d, cl:o.cl}));
    },

    clear: function() {
        this.waves = [];
    },

    update: function() {
        for (let i = 0; i < this.waves.length; i++) {
            this.waves[i].update();
        }
    },

    draw: function() {
        if (this.waves.length > 0) {
            this.ctx.clearRect(0,0, this.can.width, this.can.height);
            for (let i = 0; i < this.waves.length; i++) {
                const wave = this.waves[i];
                this.ctx.beginPath();
                this.ctx.moveTo(0, this.can.height);
                for (let j = 0; j < this.can.width / 30 + 1; j++) {
                    hl = wave.y + Math.sin(30 * j * wave.r + wave.a) * wave.w;
                    this.ctx.lineTo(30 * j, hl);
                }
                this.ctx.lineTo(this.can.width, this.can.height);
                this.ctx.fillStyle = wave.cl;
                this.ctx.fill();
            }
            
            
        }
    },

    animate: function() {
        this.update();
        this.draw();
        requestAnimationFrame(this.animate.bind(this))
    }
}

const wave = {
    create: function(o) {
        let obj = Object.create(this);
        obj.w = o.w || 0.01 * o.bh;
        obj.ox = o.ox || o.bw / 2;
        obj.oy = o.oy || o.bh / 2;
        obj.f = o.f || 0.05;
        obj.y = o.y || o.bh / 4 * 3;
        obj.r = o.r || 0.0015;
        obj.d = o.d || 220;
        obj.a = 0;
        obj.cl = o.cl || '#000';
        obj.fr = obj.r;
        obj.fw = obj.w;
        obj.ff = obj.f;
        obj.fy = obj.y;
        obj.tr = obj.r;
        obj.tw = obj.w;
        obj.tf = obj.f;
        obj.ty = obj.y;
        obj.counter = 0;
        obj.variant = false;
        obj.isFixed = true;
        return obj;
    },

    startAnimate: function() {
        this.time = Date.now();
        this.animate = true;
    },

    update: function(){
        this.a += this.f;
        if (this.variant) {
            if (this.isFixed) {
                if (Math.random() < 0.5) {
                    this.isFixed = false;
                    this.tr = Math.random() * 0.005 + 0.001;
                    // this.tf = Math.random() * 0.2 - 0.1;
                    this.tw = (Math.random() * 0.005 + 0.005) * bw;
                    this.fw = this.w;
                    this.fr = this.r;
                }
            } else {
                if (this.counter > 300) {
                    console.log(this.tr, this.tw);
                    this.counter = 0;
                    this.isFixed = true;
                    this.r = this.tr;
                    // this.f = this.tf;
                    this.w = this.tw;
                } else {
                    this.r += (this.tr - this.fr) / 300;
                    // this.f += (this.tf - this.f) / 100;
                    this.w += (this.tw - this.fw) / 300;
                    this.counter++;
                }
            }
        }

        if (this.animate) {
            let t = Date.now();
            let dt = t - this.time;
            if (dt < this.duration) {
                let dy = easeOutQuad(dt, this.fy, this.ty - this.fy, this.duration);
                this.y = dy;
            } else {
                this.y = this.ty;
                this.animate = false; 
            }
        }
    }
}





