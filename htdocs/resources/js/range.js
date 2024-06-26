// Range Input
function SliderFun(ele) {
  ele.each(function() {
    const element = $(this);
    const values = parseInt(element.val());
    const minValue = parseInt(element.attr("min"));
    const maxValue = parseInt(element.attr("max"));
    
    // Calcular el porcentaje relativo del valor
    const rangePercentage = ((values - minValue) / (maxValue - minValue)) * 100;
    
    // Asegurar que el valor esté dentro del rango
    const clampedValue = Math.min(Math.max(values, minValue), maxValue);

    // Actualizar la barra activa y el punto activo
    const rangeLine = element.closest(".range-item").find(".active-line");
    const activeDot = element.closest(".range-item").find(".active-dot");
    const valueIndicator = activeDot.next(".value-indicator");

    rangeLine.css("width", rangePercentage + "%");
    activeDot.css("left", rangePercentage + "%");
    
    // Mostrar el valor debajo de la bola
    valueIndicator.text(clampedValue); // Actualizar el contenido con el valor actual
    const dotWidth = activeDot.width();
    const indicatorWidth = valueIndicator.width();
    const indicatorLeft = rangePercentage - (indicatorWidth / 2) + (dotWidth / 2);
    valueIndicator.css("left", indicatorLeft + "%");

    // Actualizar la lista de valores
    const vals = clampedValue / 8;
    const ulList = element.closest(".range-item").find("ul li");

    ulList.each(function(index) {
      if (index <= vals) {
        $(this).addClass("active");
      } else {
        $(this).removeClass("active");
      }
    });
  });
}

// Llamar a la función SliderFun para inicializar los valores
SliderFun($(".range-input input"));

// Escuchar el evento de entrada en el rango de entrada y llamar a SliderFun
$(".range-input input").on("input", function () {
  SliderFun($(this));
});

$(document).ready(function() {
  // Función para alternar entre las vistas de banner y map
  function toggleViews(view) {
    if (view === "banner") {
        $("#bannerPreview").show();
        $("#mapPreview").hide();
    } else if (view === "map") {
        $("#bannerPreview").hide();
        $("#mapPreview").show();
    }
  }

  // Llamar a la función toggleViews para mostrar la vista inicial
  toggleViews("banner");

  // Agregar evento de clic a los elementos de encabezado para alternar las vistas
  $(".breadcrumb-item").click(function() {
      // Obtener el contenedor específico del elemento clicado
      var container = $(this).closest('.preview-container');
      // Remover la clase "active" solo de los elementos dentro de ese contenedor
      container.find(".breadcrumb-item").removeClass("active");
      // Agregar la clase "active" solo al elemento clicado
      $(this).addClass("active");
      var view = $(this).text().toLowerCase();
      toggleViews(view);
  });

});