/**
 * Script run inside a Customizer control sidebar
 */
document.addEventListener("DOMContentLoaded", function () {
  var sliders = document.querySelectorAll(".ft-range-slider");
  var ranges = document.querySelectorAll(".ft-range-slider__range");
  var values = document.querySelectorAll(".ft-range-slider__value");

  sliders.forEach((slider, index) => {
    var value = ranges[index].getAttribute("value");
    var suffix = ranges[index].getAttribute("suffix");
    values[index].innerHTML = value + " " + suffix;
  });

  ranges.forEach((range, index) => {
    range.addEventListener("input", function () {
      var suffix = range.getAttribute("suffix")
        ? range.getAttribute("suffix")
        : "";
      values[index].innerHTML = range.value + " " + suffix;
    });
  });
});
