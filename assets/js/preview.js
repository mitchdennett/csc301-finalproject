'use strict'
import { Sidebar } from './Sidebar.js';
import { ProductsPage } from './ProductsPage.js';

$(document).ready(function() {
    var sidePanel = new Sidebar();
    $.get('../../src/api.php?request=products').then((response) => {
        var page = new ProductsPage();
        sidePanel.addPage(page);
        page.addProductListView(response);
    });

    $('.final-tiles-gallery').finalTilesGallery({
        gridSize: 50,
        layout: 'final'
    });
    $('.ftg-items').lightGallery();
    
    sidePanel.appendToElement($('body'));

    $('.addtocard').click(function(event) {
        event.stopImmediatePropagation();
        var id = $(this).offsetParent().siblings().children().attr('data-id');
        var src = $(this).offsetParent().siblings().children().attr('data-src');
        sidePanel.open(id, src);
    });


});

