<script>
// jQuery is loaded after the page completes, wait for Window.onload to be valid.   
window.onload=function(){
    $("#purchase-f_name").val('Joe');
    $("#purchase-l_name").val('Shopper');
    $("#purchase-street_1").val('52 N Main ST');
    $("#purchase-street_2").val();
    $("#purchase-city").val('Johnstown');
    $("#purchase-prov").val('OH');
    $("#purchase-postal").val('43210');
    $("#purchase-country_id > option:nth-child(2)").prop('selected', true);

    $("#ccformat-number").val('4012888888881881');
    $("#ccformat-exp_month").val('11');
    $("#ccformat-exp_year").val('2018');
    $("#ccformat-cvv2").val('874');

    $("#purchase-device_count_id > optgroup:nth-child(3) > option").prop('selected', true);
    $("#purchase-time_amount_id > optgroup:nth-child(3) > option").prop('selected', true);
    $("#ccformat-type            > option:nth-child(4)").prop('selected', true);
};
</script>
