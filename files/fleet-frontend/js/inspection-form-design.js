$(function () {
    $("#box").sortable();
    $("#box").disableSelection();
});

var ImagecloneCount = 1;
var RecordcloneCount = 1;
function addItem(item_type) {
    console.log(item_type);
    switch (item_type) {
        case 'image':
            var $item = $('.form_image_item:first').clone().attr('id', 'form_image_item' + ImagecloneCount++);
            break;

        case 'record':
            var $item = $('.form_record_item:first').clone().attr('id', 'form_record_item' + RecordcloneCount++);
            break;

        default:
            break;
    }
    $('.form_items').append($item);
}

function deleteitem(item, itemtype) {
    switch (itemtype) {
        case 'image':
            ImagecloneCount--;
            if (ImagecloneCount > 0) { item.parentNode.parentNode.remove() };
            break;

        case 'record':
            RecordcloneCount--;
            if (RecordcloneCount > 0) { item.parentNode.parentNode.remove() };

            break;
        default:
            break;
    }
    ;
}

function setBtnValue(btn) {
    $('#' + btn.name)[0].innerText = btn.value;
}