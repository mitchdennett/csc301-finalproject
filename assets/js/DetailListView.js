import { Detail } from './Detail.js';

export class DetailListView {
    constructor(){
        
    }

    appendToElement(el) {
        this.createElement();
        this.setupHandlers();
        el.append(this.element);
    }

    setupHandlers() {
        
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    addDetails(details) {
        this.details = [];

        for(var x in details){
            var d = details[x];
            var detail = new Detail(d);
            detail.sidebar = this.sidebar;
            detail.appendToElement(this.element.find('tbody'));
        }
    }

    getElementString() {
        return `<div class="panel-items">
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>`;
    }
}