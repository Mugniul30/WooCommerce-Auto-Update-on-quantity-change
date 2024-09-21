jQuery(document).ready(function($) {
    // Event when quantity is increased or decreased
    $(document).on('change', 'input.qty', function() {
        let productId = $(this).closest('form.cart').find('input[name="product_id"]').val();
        let quantity = $(this).val();

        // Trigger AJAX request
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_quantity',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    console.log("Cart updated successfully");
                    $(document.body).trigger('wc_fragment_refresh');
                }
            }
        });
    });
});
