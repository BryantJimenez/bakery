(function() {
  "use strict";

  $('[data-toggle="tooltip"]').tooltip();

  // loader
  var loader = function() {
    setTimeout(function() { 
      if($('#ftco-loader').length>0) {
        $('#ftco-loader').removeClass('show');
      }
    }, 1);
  };
  loader();

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('fa-bars')
    this.classList.toggle('fa-times')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('fa-bars')
        navbarToggle.classList.toggle('fa-close')
      }
      scrollto(this.hash)
    }
  }, true)
})()

// Inputs complements validation
function validationModalComplements(id) {
  var max=parseInt($('#modal-product .modal-complements').attr('max')), length=$('#modal-product .modal-complements ul input:checked').length;

  if (!$('#modal-product .modal-complements input[value="'+id+'"]').attr('checked')) {
    $('#modal-product .modal-complements input[value="'+id+'"]').attr('checked', true);
  } else {
    $('#modal-product .modal-complements input[value="'+id+'"]').attr('checked', false);
  }

  if (max<=length) {
    $('#modal-product .modal-complements ul input:not(:checked)').each(function(index, el) {
      $(this).attr('disabled', true);
    });
  } else {
    $('#modal-product .modal-complements ul input[disabled]').each(function(index, el) {
      $(this).attr('disabled', false);
    });
  }

  $('#modal-product .modal-complements ul input.disabled').each(function(index, el) {
    $(this).attr('disabled', true);
  });
}

// Add complements and continue
function nextModalComplements() {
  var complements=[], validationComplements=true, complementsCount=0, i=0;
  var groupMin=parseInt($('#modal-product .modal-complements').attr('min')), groupMax=parseInt($('#modal-product .modal-complements').attr('max'));

  $('#modal-product .modal-complements input[checked]').each(function(index, el) {
    complements[i]=$(this).val();
    complementsCount++;
    i++;
  });

  validationComplements=validationRequired(validationComplements, complementsCount, groupMin, groupMax);

  if (validationComplements) {
    $('#next-complements').attr('disabled', true);
    var data={"complements": complements};
    Livewire.emit('nextStepComplements', data);
  }
}

// Add product to cart
function addProductCart() {
  var complements=[], validationComplements=true, complementsCount=0, i=0;
  var groupMin=parseInt($('#modal-product .modal-complements').attr('min')), groupMax=parseInt($('#modal-product .modal-complements').attr('max'));

  $('#modal-product .modal-complements input[checked]').each(function(index, el) {
    complements[i]=$(this).val();
    complementsCount++;
    i++;
  });

  validationComplements=validationRequired(validationComplements, complementsCount, groupMin, groupMax);

  if (validationComplements) {
    $('#add-cart').attr('disabled', true);
    var data={"complements": complements};
    Livewire.emit('addCart', data);
  }
}

function validationRequired(validationComplements, complementsCount, groupMin, groupMax) {
  var validationMinComplements=true, validationMaxComplements=true;
  validationComplements=false;

  if (complementsCount<groupMin) {
    validationMinComplements=false;
    if (groupMin>1) {
      $('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.min', groupMin, {min: groupMin}));
    } else {
      $('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.min', 1));
    }
  }

  if (complementsCount>groupMax) {
    validationMaxComplements=false;
    if (groupMax>1) {
      $('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.max', groupMax, {max: groupMax}));
    } else {
      $('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.max', 1));
    }
  }

  if (validationMinComplements && validationMaxComplements) {
    validationComplements=true;
    $('#modal-product .modal-complements p').text("");
  }

  return validationComplements;
}