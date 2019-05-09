$('.icp-dd').iconpicker(function (event){
    event.preventDefault();
});
$('.icp-dd').on('iconpickerSelected', function(event){
    $("#categorie_form_Icon").val(event.iconpickerValue);
});
