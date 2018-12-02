import { Product } from './Product.js';

export class CategoryTabView {
    constructor(category, isActive){
        this._active = isActive;
        this.category = category;
        
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

    addProducts() {
        for(var x in this.category.products){
            var p = this.category.products[x];
            var product = new Product(p);
            product.sidebar = this.sidebar;
            product.appendToElement(this.element.find('tbody'));
        }
    }

    set active(active) {
        this._active = active;
    }

    getElementString() {
        return `<div id="cat_${ this.category.categoryid }" class="tab-pane ${ this._active ? 'active' : '' }" role="tabpanel" aria-expanded="${ this._active }">
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>`;
    }
}