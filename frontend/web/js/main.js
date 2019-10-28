function AddItem(id) {
    $.ajax({
        url: '/cart/add',
        type: 'POST',
        data: {id: id},
        success: function () {
            $fcname = "RemoveItem(" + id + ")";
            $('#prod-' + id)
                .html('Удалить из корзины')
                .attr('onclick', $fcname)
                .attr('class', 'good-item__btn-delete btn btn-danger');
        },
        error: function () {
            alert('Error!');
        }
    });
}

function RemoveItem(id) {
    $.ajax({
        url: '/cart/remove',
        type: 'POST',
        data: {id: id},
        success: function () {
            $fcname = "AddItem(" + id + ")";
            $('#prod-' + id)
                .html('Добавить в корзину')
                .attr('onclick', $fcname)
                .attr('class', 'good-item__btn-add btn btn-success');
        },
        error: function () {
            alert('Error!');
        }
    });
}