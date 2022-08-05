$(() => {
    // bootstrap tooltips init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })


    
    $("#form_country").hide();
    $('#getFromApi').on('click', (e) => {
        $('body').addClass('busy')
        let pais = $('#searchcountry').val();
        pais = pais.substring(pais.indexOf(' ') + 1);
        if (!pais) {          
            alert('Please fill country name', 'warning')
            $('body').removeClass('busy')
            return;
        }

        console.log("Pais", pais)
        let getint =  $.get(`/api/country_by_name/${pais}`);
    
        getint.then((res) => {
           
            switch (res.status) {
                case 400:
                    console.log("existe")
                    alert('The country already exists please edit it', 'warning')
                    break;
                case 404:
                    console.log("no existe")
                    alert('We could not find the country you were looking for, please verify the data entered.', 'danger')
                    break;
                case 200:
                    let country = res[0]
                    fillForm(country)
                    break;
                default:
                    break;
            }
            $('body').removeClass('busy')
        });
    }) 
    

        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const alert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('')

        alertPlaceholder.append(wrapper)
        }
    
        let mapurl = $('#country_map').val();
        $('#viewmap').on('click', () => {
            window.open(mapurl)  
        });
    
    const getint = ((res) => {
        console.log(res)
        window.location.reload()
    });

    $('.contrydelete').on('click', (e) => {
       
        const button = document.querySelector('.contrydelete');
        let id = button.dataset.valor
        console.log(id)
        
        let url = `/api/delete_by_id/${id}`;
        $.ajax({
            url,
            type: 'DELETE',
            success: getint
        });
    
  

     }) 
            
    const fillForm = (country) => {
        let currency = country.currencies
        currency = Object.values(currency)[0].name;
        let languages = Object.values(country.languages).join(',')
        $('#country_name').val(country.name.common)
        $('#country_full_name').val(country.name.official)
        $('#country_code').val(country.cca3)
        $('#country_currency').val(currency)
        $('#country_language').val(languages)
        $('#country_capital_city').val(country.capital)
        $('#country_region').val(country.region)
        $('#country_sub_region').val(country.subregion)
        $('#country_flag').val(country.flag)
        $('#country_map').val(country.maps.googleMaps)
        $('#country_population').val(country.population)
        $('#country_area').val(country.area)
        $("#form_country").show();
        $("#form_search").hide();
    }
    $("#btn_new_country").on('click', () => {
        console.log("Load country")
        let list = $("#countrylist");
        let getcountries = $.get(`/api/get_all_country`);
        getcountries.then((res) => {
            let str;
            res.map((c) => {
                 str += `<option value="${c.flag} ${c.name.common}"></option>`
               
               return console.log(c)  
            })
          
            list.html(str);
        });
        

    })

});

