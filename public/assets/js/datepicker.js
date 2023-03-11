function addDays(date, days) {
  const dat = date;
  dat.setDate(dat.getDate() + days);
  return dat;
}

$(document).ready(function() {
  $(".checkInDate").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
    minDate: 0,
    showMonthAfterYear: true,
    onSelect: function(selectedDate) {
      console.log(selectedDate)
      $('.checkOutDate').datepicker('option', 'minDate', addDays(new Date(selectedDate), 1));
    }
  });
  $(".checkOutDate").datepicker({
    changeMonth: true,
    minDate: 1,
    changeYear: true,
    dateFormat: "yy-mm-dd",
    showMonthAfterYear: true
  });
});
