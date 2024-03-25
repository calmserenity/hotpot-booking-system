// booking_script.js
document.addEventListener('DOMContentLoaded', function() {
    // Function to update the displayed values and display the original price
    function updateDisplay() {
        // Removed the line that updates the email display
        document.getElementById("nameDisplay").textContent = document.getElementById("nameInput").value;
        document.getElementById("packageDisplay").textContent = document.getElementById("packageInput").value;
        document.getElementById("paxDisplay").textContent = document.getElementById("paxInput").value;
        document.getElementById("dateDisplay").textContent = document.getElementById("dateInput").value;
        document.getElementById("timeDisplay").textContent = document.getElementById("timeInput").value;
        document.getElementById("payTypeDisplay").textContent = document.getElementById("payTypeInput").value;

        // Display the original price for the selected package
        var packageInput = document.getElementById("packageInput");
        var subtotalDisplay = document.getElementById("subtotalDisplay");

        var selectedPackage = packageInput.value; 

        var selectedPackageDetails = packages.find(function(pkg) {
            return pkg.package_name === selectedPackage;
        });

        if (selectedPackageDetails) {
            var price = selectedPackageDetails.price;
            var pax = selectedPackageDetails.pax;
            
            // Ensure price is a number before calling toFixed
            if (typeof price === 'number') {
                subtotalDisplay.textContent = "RM " + price.toFixed(2);
            } else {
                // Convert price to a number if it's not already
                price = parseFloat(price);
                if (!isNaN(price)) {
                    subtotalDisplay.textContent = "RM " + price.toFixed(2);
                } else {
                    console.error('Price is not a valid number:', price);
                    subtotalDisplay.textContent = "Error: Price not available.";
                }
            }

            // Set the max attribute of the PAX input field based on the selected package's PAX value
            paxInput.setAttribute('max', pax);
        } else {
            subtotalDisplay.textContent = "Please select a package.";
            // Reset the max attribute of the PAX input field if no package is selected
            paxInput.removeAttribute('max');
        }
        }


    document.getElementById("nameInput").addEventListener("input", updateDisplay);
    document.getElementById("packageInput").addEventListener("change", updateDisplay);
    document.getElementById("paxInput").addEventListener("input", updateDisplay);
    document.getElementById("dateInput").addEventListener("input", updateDisplay);
    document.getElementById("timeInput").addEventListener("input", updateDisplay);
    document.getElementById("payTypeInput").addEventListener("change", updateDisplay);
});