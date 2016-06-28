$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: 5
});
window.setTimeout(function() {
        $(".alert").fadeTo(750, 0).slideUp(750, function(){
            $(this).remove(); 
        });
}, 1500);