main = {
  initialize: function(){
    this.bindEvents();
    this.validator();
    this.formularis();

    if($(".datatable").length > 0){
     $('.datatable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.6/i18n/Catalan.json"
        },
        responsive: true,
       
     });
    }


  },

  bindEvents: function(){
    $(".set-idioma").on('click',main.setIdioma);
  },

  setIdioma: function(){
    var id = $(this).data('id');
    console.log(id);
    var data = {'ID':id};

    ajax.getJSON("ajax/setIdioma",data,main.setIdiomaOk,main.setIdiomaFail);
  },

  setIdiomaOk: function(data){
    if(data.status == 'success'){
      location.reload();
    }else{
      console.log('Fail response');
      console.log(data.result);
    }
  },

  setIdiomaFail: function(data){
    console.log('Fail');
    console.log(data);
  },

  // FORM VALIDATOR
  validator: function(){

    jQuery.extend(jQuery.validator.messages, {
      required: "Aquest camp es obligatori",
      remote: "Si us plau, omple aquest camp",
      email: "Escriu una direcció d'email vàlida",
      url: "escriu una url vàlida",
      date: "escriu una data vàlida",
      dateISO: "Por favor, escribe una fecha (ISO) válida.",
      number: "Por favor, escribe un número entero válido.",
      digits: "Por favor, escribe sólo dígitos.",
      creditcard: "Por favor, escribe un número de tarjeta válido.",
      equalTo: "Has d'escriure el mateix valor de nou",
      accept: "Por favor, escribe un valor con una extensión aceptada.",
      maxlength: jQuery.validator.format("no pots escriure més de  {0} caràcters."),
      minlength: jQuery.validator.format("no pots escriure menys de  {0} caràcters."),
      rangelength: jQuery.validator.format("escriu un valor entre {0} i {1} caràcters."),
      range: jQuery.validator.format("Escriu un valor entre {0} i {1}."),
      max: jQuery.validator.format("Has d'escriure un valor menor o igual a  {0}."),
      min: jQuery.validator.format("Has d'escriure un valor major o igual a {0}.")
    });


$(".form-validate").validate({
              //debug:true,   

              errorClass: "help-inline",
              errorElement: "span",

              highlight:function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
              },
              unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
              }
            });

},

formularis: function(){

  $('select').select2();

  $(".datepicker").datepicker({language:'ca'});

  $(".datepicker-year").datepicker({
    language:'ca',
    format: "yyyy",
    startView: 1,
    minViewMode: 2,
  });
}



};

main.initialize();
