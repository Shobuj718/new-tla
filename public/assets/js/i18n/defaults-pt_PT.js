<<<<<<< HEAD
/*!
 * Bootstrap-select v1.13.0 (https://developer.snapappointments.com/bootstrap-select)
 *
 * Copyright 2012-2018 SnapAppointments, LLC
 * Licensed under MIT (https://github.com/snapappointments/bootstrap-select/blob/master/LICENSE)
 */

=======
/*!
 * Bootstrap-select v1.13.0 (https://developer.snapappointments.com/bootstrap-select)
 *
 * Copyright 2012-2018 SnapAppointments, LLC
 * Licensed under MIT (https://github.com/snapappointments/bootstrap-select/blob/master/LICENSE)
 */

>>>>>>> 4c989c2a89d74e21fb7494f5b2ba9f375eab6094
(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define(["jquery"], function (a0) {
      return (factory(a0));
    });
  } else if (typeof module === 'object' && module.exports) {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory(require("jquery"));
  } else {
    factory(root["jQuery"]);
  }
}(this, function (jQuery) {

<<<<<<< HEAD
(function ($) {
$.fn.selectpicker.defaults = {
	noneSelectedText: 'Nenhum seleccionado',
	noneResultsText: 'Sem resultados contendo {0}',
	countSelectedText: 'Selecionado {0} de {1}',
	maxOptionsText: ['Limite ultrapassado (máx. {n} {var})', 'Limite de seleções ultrapassado (máx. {n} {var})', ['itens', 'item']],
    multipleSeparator: ', ',
    selectAllText: 'Selecionar Tudo',
    deselectAllText: 'Desmarcar Todos'
};
})(jQuery);
=======
(function ($) {
$.fn.selectpicker.defaults = {
	noneSelectedText: 'Nenhum seleccionado',
	noneResultsText: 'Sem resultados contendo {0}',
	countSelectedText: 'Selecionado {0} de {1}',
	maxOptionsText: ['Limite ultrapassado (máx. {n} {var})', 'Limite de seleções ultrapassado (máx. {n} {var})', ['itens', 'item']],
    multipleSeparator: ', ',
    selectAllText: 'Selecionar Tudo',
    deselectAllText: 'Desmarcar Todos'
};
})(jQuery);
>>>>>>> 4c989c2a89d74e21fb7494f5b2ba9f375eab6094


}));