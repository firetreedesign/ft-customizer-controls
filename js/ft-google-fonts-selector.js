document.addEventListener('DOMContentLoaded', function() {
	var fontControls = document.querySelectorAll('.ft-google-fonts-selector');
	var fontFamilies = document.querySelectorAll('.ft-google-fonts-selector__family');
	var fontWeights = document.querySelectorAll('.ft-google-fonts-selector__weight');

	fontFamilies.forEach((family, index) => {
		family.addEventListener('input', function(e) {
			var weights = e.target.options[e.target.options.selectedIndex].dataset.weights;
			if ( '' === weights ) {
				return;
			}

			var i, L = fontWeights[index].options.length - 1;
			for(i = L; i >= 0; i--) {
				fontWeights[index].remove(i);
			}

			weightsArray = weights.split(',');
			weightsArray.forEach(weight => {
				var option = new Option(weightNames[weight], weight);
				fontWeights[index].add(option, undefined);
			});

			fontControls[index].value = escape(
				JSON.stringify(
					{
						'family': fontFamilies[index].value,
						'weight': fontWeights[index].value
					}
				)
			);

			if ("createEvent" in document) {
    			var evt = document.createEvent("HTMLEvents");
    			evt.initEvent("change", false, true);
    			fontControls[index].dispatchEvent(evt);
			} else {
				fontControls[index].fireEvent("onchange");
			}
		});
	});

	fontWeights.forEach((weight, index) => {
		weight.addEventListener('input', function(e) {
			fontControls[index].value = escape(
				JSON.stringify(
					{
						'family': fontFamilies[index].value,
						'weight': fontWeights[index].value
					}
				)
			);
			if ("createEvent" in document) {
    			var evt = document.createEvent("HTMLEvents");
    			evt.initEvent("change", false, true);
    			fontControls[index].dispatchEvent(evt);
			} else {
				fontControls[index].fireEvent("onchange");
			}
		});
	});
});