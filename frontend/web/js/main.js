$( document ).ready(function() {
    $('.oc-button').on('click', ChangeStatus);
});

function AddItem(id) {
    let qty = $('#count-' + id).val();
    $.ajax({
        url: '/cart/add',
        type: 'POST',
        data: {id: id, qty:qty},
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

function ChangeStatus()
{
    let status = $(this).data('status');
    let id = $(this).data('id');
    $.ajax({
        url: '/admin/change-status',
        type: 'POST',
        data: {id: id},
        success: function () {
            let newButtonClass = status === 0 ? "oc-button btn btn-danger" : "oc-button btn btn-success";
            let newButtonHtml = status === 0 ? "Закрыть" : "Открыть";
            let newSpanHtml = status === 0 ? "ОТКРЫТО" : "ЗАКРЫТО";
            status = status === 0 ? 1 : 0;
            $("#oc-button-"+id)
                .data('status', status)
                .attr('data-status', status)
                .attr('class', newButtonClass)
                .html(newButtonHtml);
            $('#status-span-'+id)
                .html(newSpanHtml)
                .data('status', status)
                .attr('data-status', status);
        },
        error: function () {
            alert('Error!');
        }
    });
}