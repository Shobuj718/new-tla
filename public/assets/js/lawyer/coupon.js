(function ($) {
    
    $(document).ready(function () {

        $('#applyCouponCode').click(function (e) {
            e.preventDefault();
            $('#response_message .alert').remove();
            let coupon_code = $('#coupon_code').val();
            let package_id = $('#package_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: "/apply-coupon",
                data: {
                    coupon_code: coupon_code, package_id: package_id
                }
            }).done(function (data) {
                console.log(data);
                let discountInfo = '';
                if (data.discountApplied) {
                    discountInfo = "<span class='text-success'>Coupon Code Applied Successfully for 6_Months! </span>";
                    /*$('#discountedPrice').html(discountInfo + ', Price after applying coupon: $' + data.discountedPrice );*/
                    $('#discountedPrice').html(discountInfo);
                    
                    $('#changePackageUrl').css({
                        "display": "none",
                    });
                    $('#changePackageUrlShow').css({
                        "display": "block",
                        "visibility": "visible"
                    });
                    
                    $('#discountedPrice').css({
                        "display": "block",
                        "visibility": "visible"
                    });
                } else {
                    discountInfo = "<span class='text-warning'>You've already use  this coupon ID. Discount not available at this price!</span>";
                    $('#discountedPrice').html(discountInfo);
                    $('#discountedPrice').css({
                        "display": "block",
                        "visibility": "visible"
                    });
                }

                
            }).fail(function (data) {
                console.log(data);
                let discountInfo = '';
                if (data) {
                    discountInfo = "<span class='text-danger'>Coupon code not found!</span>";
                }

                $('#discountedPrice').html(discountInfo);
                $('#discountedPrice').css({
                    "display": "block",
                    "visibility": "visible"
                });
            });
        });
    });
})(jQuery)