$(document).ready(function () {

  // Cached DOM elements
  const addNewButton = $("#addnewcity"),
        cityDetailsModal = $("#cityid"),
        filterCountryList = $("#filtercountry"),
        cityCountryList = $("#citydetailscountry"),
        filterCityNotifications = $("#filtercitynotifications"),
        cityDetailNotifications = $("#citydetailsnotifications"),
        cityNameField = $("#citydetailscityname"),
        saveCityButton = $("#savecitychanges"),
        cityIdField = $("#cityhiddenid"),
        toastElement = $("#cityToast"),
        toastBody = $("#cityToastBody");

  // Load countries into dropdowns on page load
  getCountries(filterCountryList, 'all');
  getCountries(cityCountryList, 'choose');

  // Show modal on add new button click
  addNewButton.on("click", function () {
    resetForm();
    cityDetailsModal.modal("show");
  });

  // Fetch countries
  function getCountries(selectElement, option = 'choose') {
    $.getJSON("controllers/countrycontroller.php", {
      getcountries: true
    })
    .done(function (data) {
      let options = option === 'choose'
        ? `<option value=''>-- Choose --</option>`
        : `<option value='0'>-- All --</option>`;

      data.forEach(function (country) {
        options += `<option value='${country.CountryID}'>${country.CountryName}</option>`;
      });

      selectElement.html(options);
    })
    .fail(function (response) {
      filterCityNotifications.html(`
        <div class='alert alert-danger'>
          Error fetching countries: ${response.responseText}
        </div>
      `);
    });
  }

  // Save city
  saveCityButton.on("click", function () {
    const cityId = cityIdField.val() || null,
          countryId = cityCountryList.val(),
          cityName = cityNameField.val().trim();

    // Validation
    if (countryId === "") {
      cityDetailNotifications.html(`<div class='alert alert-info'>Please select a country.</div>`);
      cityCountryList.focus();
      return;
    }

    if (cityName === "") {
      cityDetailNotifications.html(`<div class='alert alert-info'>Please enter a city name.</div>`);
      cityNameField.focus();
      return;
    }

    // AJAX
    $.ajax({
      url: "controllers/citycontroller.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        CityID: cityId,
        CityName: cityName,
        CountryID: countryId
      }),
      success: function (response) {
        if (isJSON(response)) {
          const data = JSON.parse(response);

          if (data.success) {
            showPopup("City saved successfully!", "success");
            resetForm(); // Keep modal open
          } else {
            const errorMsg = data.error || "Failed to save city.";
            cityDetailNotifications.html(`<div class='alert alert-danger'>${errorMsg}</div>`);
          }
        } else {
          cityDetailNotifications.html(`<div class='alert alert-danger'>Invalid server response: ${response}</div>`);
        }
      },
      error: function (xhr) {
        cityDetailNotifications.html(`<div class='alert alert-danger'>Error: ${xhr.responseText}</div>`);
      }
    });
  });

  // JSON check
  function isJSON(str) {
    try {
      JSON.parse(str);
      return true;
    } catch (e) {
      return false;
    }
  }

  // Toast popup for Bootstrap 4
  function showPopup(message, type = "success") {
    toastBody.text(message);

    // Update background color
    toastElement.removeClass("bg-success bg-danger").addClass(`bg-${type}`);
    toastElement.find(".toast-header").removeClass("bg-success bg-danger").addClass(`bg-${type}`);

    // Show toast
    toastElement.toast({ delay: 3000 });
    toastElement.toast("show");
  }

  // Reset form
  function resetForm() {
    cityIdField.val("");
    cityNameField.val("");
    cityCountryList.val("");
    cityDetailNotifications.html("");
  }

});
