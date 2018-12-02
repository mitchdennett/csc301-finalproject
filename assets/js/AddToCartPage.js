import { DetailListView } from './DetailListView.js';

export class AddToCartPage {
    constructor(detail){
        this.detail = detail;
        
    }

    appendToElement(el) {
        if(!this.element){
            this.createElement();
            this.setupHandlers();
        }
        el.append(this.element);
    }

    setupHandlers() {
        this.element.find('.qty').click((event) => {
            this.onQtyChange(event);
        });

        this.element.find('#addToCartButton').click((event) => {
            this.addToCart(event);
        });
        
    }

    setImgSrc(src) {
        this.element.find('#panel-img-lg').attr('src', src);
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    addToCart(event) {
        var item = {
            detailid: this.detail.detailid,
            qty: this.element.find('.qty').val(),
            gallery_item: this.sidebar.galleryItemId
        };
        $.post('../../src/api.php?request=cart', {
            data: JSON.stringify(item)
        }).done((response) => {
            $('#cartNumber').html(response.count);
            this.sidebar.close();
        });
    }
    
    onQtyChange(event) {
        var total = this.element.find('.qty').val() * this.detail.price;
        this.element.find('#subtotal').html('$' + total);
    }

    getElementString() {
        return `<div class="cd-panel__content">
                    <div style="text-align: center;">
                        <img id="panel-img-lg" src="">
                    </div>
                    <div class="panel-items">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Quantity: </label>
                                <input class="form-control qty" type="number" value=1>
                            </div>
                            <div class="col-md-6">
                                <label>Subtotal: </label>
                                <div id="subtotal">
                                    $${this.detail.price}
                                </div>
                            </div>
                        </div>
                        <div style="text-align:center;">
                            <button id="addToCartButton" class="btn btn-primary">Add To Cart</button>
                        </div>

                    </div>
                </div>`;
    }
}