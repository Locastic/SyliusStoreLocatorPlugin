'use strict';

(function ($) {

    let $storeImagesCollection;
    let $addStoreImageButton = $('<button type="button" class="ui labeled icon button" style="width: 100%"><i class="plus square outline icon"></i>Add new image</button>');
    let $newLinkLi = $('<div></div>').append($addStoreImageButton);

    jQuery(document).ready(function () {

        $storeImagesCollection = $('ul.storeImages');
        $storeImagesCollection.append($newLinkLi);

        $storeImagesCollection.find('li').each(function () {
            addStoreImageFormDeleteLink($(this));
        });

        $addStoreImageButton.on('click', function () {
            addStoreImageForm($storeImagesCollection, $newLinkLi);
            sleep(300).then(() => {
                $('form').removeClass('loading');
            })
        });

    });

    function addStoreImageForm() {

        let numberOfExistingImages = $storeImagesCollection.find('li').length;
        let prototype = $storeImagesCollection.data('prototype');
        let newStoreImageForm = prototype;

        newStoreImageForm = newStoreImageForm.replace(/__name__/g, numberOfExistingImages + 1);
        let $newFormLi = $('<div class="column ui upload box segment"><li></li></div>').append(newStoreImageForm);
        $newLinkLi.before($newFormLi);

    }

    function addStoreImageFormDeleteLink($storeImageFormRow) {
        let $deleteStoreImageButton = $('<button type="button" class="ui red labeled icon button" style="margin-bottom: 1em; width: 100%"><i class="trash icon"></i>Delete image</button>');
        $storeImageFormRow.append($deleteStoreImageButton);
        let parentDiv = $storeImageFormRow.parent();

        $deleteStoreImageButton.on('click', function (e) {
            $storeImageFormRow.remove();
            parentDiv.remove();
        });
    }

    function sleep (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }


}(window.jQuery));