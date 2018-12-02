
export class Sidebar {

    constructor(){
        this.pages = [];
        
    }

    appendToElement(el) {
        this.createElement();
        this.setupHandlers();
        el.append(this.element);
    }

    setupHandlers() {
        this.element.find('.cd-panel__close').click((event) => {
            this.close();
        });

        this.element.find('#panel-back').click((event) => {
            this.back();
        });
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    open(id, src) {
        this.src = src;
        this.galleryItemId = id;
        this.element.find('#panel-img').attr('src', src);
        this.element.addClass('cd-panel--is-visible');
        
    }

    close() {
        this.element.removeClass('cd-panel--is-visible');
        this.element.find('.cd-panel__content').detach();
        var page = this.pages[0];
        this.pages = [];
        this.addPage(page);
    }

    back() {
        this.pages.pop();
        var length = this.pages.length;
        if(length > 0){
            var content = this.element.find('.cd-panel__content');
            content.detach();
            var page = this.pages[length - 1]
            page.appendToElement(this.element.find('.cd-panel__container'));

            if(length == 1){
                this.element.find('#panel-back').css('display', 'none');
            }
        } 
    }

    addPage(page){
        page.sidebar = this;
        var content = this.element.find('.cd-panel__content');
        content.detach();
        page.appendToElement(this.element.find('.cd-panel__container'));
        
        this.pages.push(page);
        if(this.pages.length > 1){
            this.element.find('#panel-back').css('display', 'block');
        }
    }

    getElementString() {
        return `<div id="cartpanel" class="cd-panel cd-panel--from-right js-cd-panel-main">
                    <div id="panel-content">
                        <header class="cd-panel__header">
                            <a id="panel-back" href="#0" style="float:left;display:none;"><i class="nc-icon nc-minimal-left"></i>Back</a>
                            <h1 id="panel-header">Order Prints</h1>
                            <a href="#0" class="cd-panel__close js-cd-close">Close</a>
                        </header>
                
                        <div class="cd-panel__container">
                            
                        </div>
                    </div>
                </div>`;
    }
}
