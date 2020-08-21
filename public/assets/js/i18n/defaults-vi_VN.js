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
    noneSelectedText: 'Chưa chọn',
    noneResultsText: 'Không có kết quả cho {0}',
    countSelectedText: function (numSelected, numTotal) {
      return "{0} mục đã chọn";
    },
    maxOptionsText: function (numAll, numGroup) {
      return [
        'Không thể chọn (giới hạn {n} mục)',
        'Không thể chọn (giới hạn {n} mục)'
      ];
    },
    selectAllText: 'Chọn tất cả',
    deselectAllText: 'Bỏ chọn',
    multipleSeparator: ', '
  };
})(jQuery);
=======
(function ($) {
  $.fn.selectpicker.defaults = {
    noneSelectedText: 'Chưa chọn',
    noneResultsText: 'Không có kết quả cho {0}',
    countSelectedText: function (numSelected, numTotal) {
      return "{0} mục đã chọn";
    },
    maxOptionsText: function (numAll, numGroup) {
      return [
        'Không thể chọn (giới hạn {n} mục)',
        'Không thể chọn (giới hạn {n} mục)'
      ];
    },
    selectAllText: 'Chọn tất cả',
    deselectAllText: 'Bỏ chọn',
    multipleSeparator: ', '
  };
})(jQuery);
>>>>>>> 4c989c2a89d74e21fb7494f5b2ba9f375eab6094


}));
