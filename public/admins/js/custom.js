/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
function errorNotification() {
  Lobibox.notify('error', {
    title: Lang.get('admin.js.500.title'),
    sound: true,
    msg: Lang.get('admin.js.500.msg')
  });
}

$(document).ready(function() {
  // Validation to enter only numbers
  $('.number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  // Validation to enter only letters and spaces
  $('#name, #lastname, .only-letters').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  // Validation to just hit enter and delete
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  // select2
  if ($('.select2').length) {
    $('.select2').select2({
      placeholder: Lang.get('form.select.select'),
      tags: true
    });
  }

  // Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": Lang.get('admin.js.table.info', {start: '_START_', end: '_END_', total: '_TOTAL_'}),
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": Lang.get('admin.js.table.search'),
        "sLengthMenu": Lang.get('admin.js.table.length', {menu: '_MENU_'}),
        "sProcessing": Lang.get('admin.js.table.processing'),
        "sZeroRecords": Lang.get('admin.js.table.empty.zero'),
        "sEmptyTable": Lang.get('admin.js.table.empty.table'),
        "sInfoEmpty": Lang.get('admin.js.table.empty.info'),
        "sInfoFiltered": Lang.get('admin.js.table.filter', {max: '_MAX_'}),
        "sInfoPostFix": "",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": Lang.get('admin.js.table.loading'),
        "oAria": {
          "sSortAscending": Lang.get('admin.js.table.sort.asc'),
          "sSortDescending": Lang.get('admin.js.table.sort.desc')
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": Lang.get('admin.js.table.info', {start: '_START_', end: '_END_', total: '_TOTAL_'}),
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": Lang.get('admin.js.table.search'),
        "sLengthMenu": Lang.get('admin.js.table.length', {menu: '_MENU_'}),
        "sProcessing": Lang.get('admin.js.table.processing'),
        "sZeroRecords": Lang.get('admin.js.table.empty.zero'),
        "sEmptyTable": Lang.get('admin.js.table.empty.table'),
        "sInfoEmpty": Lang.get('admin.js.table.empty.info'),
        "sInfoFiltered": Lang.get('admin.js.table.filter', {max: '_MAX_'}),
        "sInfoPostFix": "",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": Lang.get('admin.js.table.loading'),
        "oAria": {
          "sSortAscending": Lang.get('admin.js.table.sort.asc'),
          "sSortDescending": Lang.get('admin.js.table.sort.desc')
        },
        "buttons": {
          "copy": Lang.get('admin.js.table.buttons.copy'),
          "print": Lang.get('admin.js.table.buttons.print')
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  // dropify for more custom input file
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: Lang.get('admin.js.file.messages.default'),
        replace: Lang.get('admin.js.file.messages.replace'),
        remove: Lang.get('admin.js.file.messages.remove'),
        error: Lang.get('admin.js.file.messages.error')
      },
      error: {
        'fileSize': Lang.get('admin.js.file.error.fileSize', {value: '{{ value }}'}),
        'minWidth': Lang.get('admin.js.file.error.minWidth', {value: '{{ value }}'}),
        'maxWidth': Lang.get('admin.js.file.error.maxWidth', {value: '{{ value }}'}),
        'minHeight': Lang.get('admin.js.file.error.minHeight', {value: '{{ value }}'}),
        'maxHeight': Lang.get('admin.js.file.error.maxHeight', {value: '{{ value }}'}),
        'imageFormat': Lang.get('admin.js.file.error.imageFormat', {value: '{{ value }}'})
      }
    });
  }

  // datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : locale,
      time: false,
      cancelText: Lang.get('admin.js.date.cancel'),
      clearText: Lang.get('admin.js.date.clear'),
      format: 'DD-MM-YYYY',
      maxDate : new Date()
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: locale,
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  if ($('#startTimeFlatpickr').length && $('#endTimeFlatpickr').length) {
    var startFlatpickr=flatpickr(document.getElementById('startTimeFlatpickr'), {
      locale: locale,
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: false,
      maxTime: "23:59",
      onChange: function(selectedDates, dateStr, instance) {
        endFlatpickr.set("minTime", $("#startTimeFlatpickr").val());
      }
    });

    var endFlatpickr=flatpickr(document.getElementById('endTimeFlatpickr'), {
      locale: locale,
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: false,
      minTime: "00:00",
      onChange: function(selectedDates, dateStr, instance) {
        startFlatpickr.set("maxTime", $("#endTimeFlatpickr").val());
      }
    });
  }

  //touchspin
  if ($('.int').length) {
    $(".int").TouchSpin({
      min: 0,
      max: 999999999,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.qty').length) {
    $(".qty").TouchSpin({
      min: 1,
      max: 999999999,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.min-decimal').length) {
    $(".min-decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.05,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.int-max-100').length) {
    $(".int-max-100").TouchSpin({
      min: 0,
      max: 100,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.int-positive').length) {
    $(".int-positive").TouchSpin({
      min: 1,
      max: 999999999,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.discount').length && $('#typeCoupon').length) {
    var max=1, step=1, decimals=0;
    if ($('#typeCoupon').val()!='') {
      if ($('#typeCoupon').val()=='1') {
        max=100;
        step=1;
        decimals=0;
      } else if ($('#typeCoupon').val()=='2') {
        max=999999999;
        step=0.05;
        decimals=2;
      }
    }
    $(".discount").TouchSpin({
      min: 1,
      max: max,
      step: step,
      decimals: decimals,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  // CKeditor plugin
  if ($('#content-term').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-term');
  }

  if ($('#content-privacity').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-privacity');
  }

  if ($('.content-term').length) {
    $('.content-term').each(function(index) {
      CKEDITOR.config.height=250;
      CKEDITOR.config.width='auto';
      CKEDITOR.replace($(this).attr("id"));
    });
  }

  if ($('.content-privacity').length) {
    $('.content-privacity').each(function(index) {
      CKEDITOR.config.height=250;
      CKEDITOR.config.width='auto';
      CKEDITOR.replace($(this).attr("id"));
    });
  }
});

// function to change the hidden input when changing the status switch
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

// function to change discount touchspin for the type of coupon
$('#typeCoupon').change(function(event) {
  $(".discount").trigger("touchspin.updatesettings", {max: 1, step: 1, decimals: 0});
  if ($(this).val()!='') {
    if ($(this).val()=='1') {
      $(".discount").trigger("touchspin.updatesettings", {max: 100, step: 1, decimals: 0});
    } else if ($(this).val()=='2') {
      $(".discount").trigger("touchspin.updatesettings", {max: 999999999, step: 0.05, decimals: 2});
    }
  }
});

// functions to deactivate and activate
function deactiveUser(slug) {
  $("#deactiveUser").modal();
  $('#formDeactiveUser').attr('action', '/admin/users/' + slug + '/deactivate');
}

function activeUser(slug) {
  $("#activeUser").modal();
  $('#formActiveUser').attr('action', '/admin/users/' + slug + '/activate');
}

function deactiveCustomer(slug) {
  $("#deactiveCustomer").modal();
  $('#formDeactiveCustomer').attr('action', '/admin/customers/' + slug + '/deactivate');
}

function activeCustomer(slug) {
  $("#activeCustomer").modal();
  $('#formActiveCustomer').attr('action', '/admin/customers/' + slug + '/activate');
}

function deactiveCategory(slug) {
  $("#deactiveCategory").modal();
  $('#formDeactiveCategory').attr('action', '/admin/categories/' + slug + '/deactivate');
}

function activeCategory(slug) {
  $("#activeCategory").modal();
  $('#formActiveCategory').attr('action', '/admin/categories/' + slug + '/activate');
}

function deactiveProduct(slug) {
  $("#deactiveProduct").modal();
  $('#formDeactiveProduct').attr('action', '/admin/products/' + slug + '/deactivate');
}

function activeProduct(slug) {
  $("#activeProduct").modal();
  $('#formActiveProduct').attr('action', '/admin/products/' + slug + '/activate');
}

function deactiveComplement(slug) {
  $("#deactiveComplement").modal();
  $('#formDeactiveComplement').attr('action', '/admin/complements/' + slug + '/deactivate');
}

function activeComplement(slug) {
  $("#activeComplement").modal();
  $('#formActiveComplement').attr('action', '/admin/complements/' + slug + '/activate');
}

function deactiveGroup(slug) {
  $("#deactiveGroup").modal();
  $('#formDeactiveGroup').attr('action', '/admin/groups/' + slug + '/deactivate');
}

function activeGroup(slug) {
  $("#activeGroup").modal();
  $('#formActiveGroup').attr('action', '/admin/groups/' + slug + '/activate');
}

function rejectedOrder(slug) {
  $("#rejectedOrder").modal();
  $('#formRejectedOrder').attr('action', '/admin/orders/' + slug + '/reject');
}

function confirmedOrder(slug) {
  $("#confirmedOrder").modal();
  $('#formConfirmedOrder').attr('action', '/admin/orders/' + slug + '/confirm');
}

function deactiveAgency(slug) {
  $("#deactiveAgency").modal();
  $('#formDeactiveAgency').attr('action', '/admin/agencies/' + slug + '/deactivate');
}

function activeAgency(slug) {
  $("#activeAgency").modal();
  $('#formActiveAgency').attr('action', '/admin/agencies/' + slug + '/activate');
}

function deactiveAttribute(slug) {
  $("#deactiveAttribute").modal();
  $('#formDeactiveAttribute').attr('action', '/admin/attributes/' + slug + '/deactivate');
}

function activeAttribute(slug) {
  $("#activeAttribute").modal();
  $('#formActiveAttribute').attr('action', '/admin/attributes/' + slug + '/activate');
}

function deactiveCoupon(slug) {
  $("#deactiveCoupon").modal();
  $('#formDeactiveCoupon').attr('action', '/admin/coupons/' + slug + '/deactivate');
}

function activeCoupon(slug) {
  $("#activeCoupon").modal();
  $('#formActiveCoupon').attr('action', '/admin/coupons/' + slug + '/activate');
}

function deactiveCurrency(slug) {
  $("#deactiveCurrency").modal();
  $('#formDeactiveCurrency').attr('action', '/admin/currencies/' + slug + '/deactivate');
}

function activeCurrency(slug) {
  $("#activeCurrency").modal();
  $('#formActiveCurrency').attr('action', '/admin/currencies/' + slug + '/activate');
}

function deactiveSchedule(id) {
  $("#deactiveSchedule").modal();
  $('#formDeactiveSchedule').attr('action', '/admin/schedules/' + id + '/deactivate');
}

function activeSchedule(id) {
  $("#activeSchedule").modal();
  $('#formActiveSchedule').attr('action', '/admin/schedules/' + id + '/activate');
}

// functions to ask when deleting
function deleteUser(slug) {
  $("#deleteUser").modal();
  $('#formDeleteUser').attr('action', '/admin/users/' + slug);
}

function deleteCustomer(slug) {
  $("#deleteCustomer").modal();
  $('#formDeleteCustomer').attr('action', '/admin/customers/' + slug);
}

function deleteCategory(slug) {
  $("#deleteCategory").modal();
  $('#formDeleteCategory').attr('action', '/admin/categories/' + slug);
}

function deleteProduct(slug) {
  $("#deleteProduct").modal();
  $('#formDeleteProduct').attr('action', '/admin/products/' + slug);
}

function deleteComplement(slug) {
  $("#deleteComplement").modal();
  $('#formDeleteComplement').attr('action', '/admin/complements/' + slug);
}

function deleteGroup(slug) {
  $("#deleteGroup").modal();
  $('#formDeleteGroup').attr('action', '/admin/groups/' + slug);
}

function deleteAgency(slug) {
  $("#deleteAgency").modal();
  $('#formDeleteAgency').attr('action', '/admin/agencies/' + slug);
}

function deleteAttribute(slug) {
  $("#deleteAttribute").modal();
  $('#formDeleteAttribute').attr('action', '/admin/attributes/' + slug);
}

function deleteCoupon(slug) {
  $("#deleteCoupon").modal();
  $('#formDeleteCoupon').attr('action', '/admin/coupons/' + slug);
}

function deleteCurrency(slug) {
  $("#deleteCurrency").modal();
  $('#formDeleteCurrency').attr('action', '/admin/currencies/' + slug);
}

function deleteSchedule(id) {
  $("#deleteSchedule").modal();
  $('#formDeleteSchedule').attr('action', '/admin/schedules/' + id);
}

// Function to open modal to assign groups to a product
function assignGroup(slug, name=null) {
  $('#formAssignProductGroup .select2').val('');
  $('#formAssignProductGroup .select2').val('').trigger('change');
  $('#formAssignProductGroup').attr('action', '/admin/products/'+slug+'/assign');
  if (name!=null && name!="") {
    $('#nameAssignProductGroup').text(name);
    $.ajax({
      url: '/admin/products/'+slug+'/groups',
      type: 'POST',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      if (obj.status) {
        $('#formAssignProductGroup .select2').val(obj.groups).trigger("change");
        $("#assignProductGroup").modal();
      } else {
        errorNotification();
      }
    })
    .fail(function() {
      errorNotification();
    });
  } else {
    errorNotification();
  }
}

// Add Add-ons to a Group
$('#add-complements').click(function(event) {
  var count=parseInt($('#group-complements div[complement]:last-child').attr('complement'))+1;

  $.ajax({
    url: '/admin/groups/complements',
    type: 'POST',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {
      $('#group-complements').append($('<div>', {
        class: 'row',
        complement: count
      }));

      $('#group-complements div[complement="'+count+'"]').html('<div class="col-12">'+
        '<hr class="my-2">'+
        '</div>'+
        '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">'+
        '<label class="col-form-label">'+Lang.get('form.complement.label')+'<b class="text-danger">*</b></label>'+
        '<select class="form-control" name="complement_id[]" complement="'+count+'" id="complement_'+count+'">'+
        '<option value="">'+Lang.get('form.select.select')+'</option>'+
        '</select>'+
        '</div>'+
        '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12">'+
        '<label class="col-form-label">'+Lang.get('form.price.label')+'<b class="text-danger">*</b></label>'+
        '<input class="form-control min-decimal" type="text" name="price[]" required placeholder="'+Lang.get('form.complement.placeholder')+'" value="0.00" complement="'+count+'" id="price_'+count+'">'+
        '</div>'+
        '<div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-5 col-10">'+
        '<label class="col-form-label">Estado<b class="text-danger">*</b></label>'+
        '<select class="form-control" name="state[]" required id="state_'+count+'">'+
        '<option value="1">'+Lang.get('admin.values_attributes.states.complements.available')+'</option>'+
        '<option value="2">'+Lang.get('admin.values_attributes.states.complements.not available')+'</option>'+
        '<option value="3">'+Lang.get('admin.values_attributes.states.complements.out of stock')+'</option>'+
        '<option value="0">'+Lang.get('admin.values_attributes.states.complements.not visible')+'</option>'+
        '</select>'+
        '</div>'+
        '<div class="form-group col-xl-1 col-lg-1 col-md-1 col-2 d-flex align-items-end">'+
        '<a href="javascript:void(0);" class="text-danger complement-remove mb-3" complement="'+count+'">'+
        '<i class="fa fa-trash"></i>'+
        '</a>'+
        '</div>');

      for (var i=obj.complements.length-1; i>=0; i--) {
        $('#complement_'+count).append($('<option>', {
          value: obj.complements[i].slug,
          text: obj.complements[i].name,
          price: obj.complements[i].price
        }));
      }

      if ($('.min-decimal').length) {
        $(".min-decimal").TouchSpin({
          min: 0,
          max: 999999999,
          step: 0.05,
          decimals: 2,
          buttondown_class: 'btn btn-primary pt-2 pb-3',
          buttonup_class: 'btn btn-primary pt-2 pb-3'
        });
      }

      // Change default price when selecting add-on
      $('#complement_'+count).on('change', function(event) {
        priceComplement($(this));
      });

      // Function to remove complements
      $('.complement-remove[complement="'+count+'"]').on('click', function(event) {
        $('#group-complements div[complement="'+$(this).attr('complement')+'"]').remove();
      });
    } else {
      errorNotification();
    }
  })
  .fail(function() {
    errorNotification();
  });
});

// Function to remove complements
$('.complement-remove').click(function(event) {
  $('#group-complements div[complement="'+$(this).attr('complement')+'"]').remove();
});

// Change default price when selecting add-on
$('select[name="complement_id[]"]').change(function(event) {
  priceComplement($(this));
});

// Function for change default price when selecting add-on
function priceComplement($selected) {
  var complement=$selected.attr('complement');
  var price=$('select[complement="'+complement+'"] option[value="'+$selected.val()+'"]').attr('price');
  $('.min-decimal[complement="'+complement+'"]').val(price);
}