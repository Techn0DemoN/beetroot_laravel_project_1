document.addEventListener("DOMContentLoaded", function () {
    function get_weather(city) {
        //let url ='http://api.openweathermap.org/data/2.5/weather?q=' + city +'&appid=6d16f9e8c0081b903573ae6f1c38ebeb';
        let url = 'http://beetroot.loc/weather-ajax';
        let user = {
            name: 'Vlad',
            last_name: 'Paramey',
            '_token': document.querySelector('meta[name="csrf-token"]').content // добавляем CSRF токен
        };


        fetch(url,
                {
                headers: {
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify(user),
            }
        )
            .then((response) => {
                return response.json();
                // return response.json();
            })
            .then((data) => {
                //     console.log(data.name);
                //     console.log(document.getElementById('weather_temp'));
                document.getElementById('weather_temp').innerHTML = data.temp;
                document.getElementById('weather_city').innerHTML = data.city;
                // document.getElementById('weather_img').src = 'http://openweathermap.org/img/wn/' + data.weather[0].icon + '@2x.png';
                document.getElementById('weather_wind').innerHTML = data.wind;
                //document.getElementById('weather_temp').innerHTML = data;
                console.log(data);
            });
    };

    get_weather('Odesa');

    document.getElementById('my_button').addEventListener('click', function (event) {
        event.preventDefault();
        let city = document.getElementById('input_weather').value;
        get_weather(city);


        // console.log(event);
        // event.target.style = 'background-color: red';
        // event.target.innerHtml = 'I am here';

        // fetch('https://learn.javascript.ru/article/fetch/logo-fetch.svg')
        //     .then((response) => {
        //         return response.blob();
        //     })
        //     .then((blob) => {
        //         console.log('>>> 2');
        //         let img = document.createElement('img');
        //         img.style = 'position:fixed;top:10px;left:10px;width:100px';
        //         document.body.append(img);
        //         img.src = URL.createObjectURL(blob);
        //     });


    })
})
