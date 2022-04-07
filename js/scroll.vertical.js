class VerticalScroll {
    constructor(o) {
        // if (checkType(o.target) == 'String') {
        //     this.target = document.getElementById(o.target);
        // } else {
        //     this.target = document.target;
        // }
        this.target = o.target;
        this.dir = o.dir || 'ltr';
        this.startX = null;
        this.startY = null;
        this.sclLeft = null;
        this.lastLeft = null;
        this.isDrag = false;
        this.dirLeft = 0;
    }

    init() {
        this.target.addEventListener('mousedown', (e) => {
            if (this.isDrag) return;
            this.isDrag = true;
            this.startX = e.pageX;
            this.startY = e.pageY;
            this.sclLeft = this.target.scrollLeft;
            this.lastLeft = this.target.scrollLeft;
        })
        
        this.target.addEventListener('mouseup', (e) => {
            this.isDrag = false;
            this.startX = null;
            this.startY = null;
            this.sclLeft = this.target.scrollLeft;
            this.final(this.dirLeft * 50);
        })
        
        this.target.addEventListener('mouseleave', (e) => {
            this.isDrag = false;
            this.startX = null;
            this.startY = null;
        })
        
        this.target.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!this.isDrag) return;
            let xd = this.startX - e.pageX;
            let yd = this.startY - e.pageY;

            if (this.dir === 'ltr') {
                this.target.scrollLeft = this.sclLeft + xd;
            } else {
                this.target.scrollLeft = this.sclLeft - xd;
            }
            if (this.lastLeft > this.target.scrollLeft)
                this.dirLeft = -1;
            else if (this.lastLeft < this.target.scrollLeft)
                this.dirLeft = 1;
            else
                this.dirLeft = 0;
            this.lastLeft = this.target.scrollLeft;
        })
    }

    final(xd) {
        xd = xd / 1.2;
        this.target.scrollLeft += xd;
        if (xd > 0.5) {
            setTimeout(()=>{
                this.final(xd);
            }, 20);
        } else if (xd < -0.5) {
            setTimeout(()=>{
                this.final(xd);
            }, 20);
        }
    }
    
}
