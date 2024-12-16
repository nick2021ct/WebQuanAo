<script>
    function delete_heart(id) {
        if (localStorage.getItem('heart') != null) {
            var data = JSON.parse(localStorage.getItem('heart'));
            var index = data.findIndex(item => item.id === id);
            data.splice(index, 1);
            localStorage.setItem('heart', JSON.stringify(data));
            document.getElementById("row_heart" + id).remove();
            document.getElementById("Myheart_" + id).src = "{{ asset('storage/img/icon/heart.png') }}";
            checkEmptyHeart();
        }
    }
    viewed_heart();

    function checkEmptyHeart() {
        var heartTable = document.getElementById("row_heart");
        var messageElement = document.getElementById("empty_heart_message");

        if (heartTable != null && heartTable.rows.length < 1) {
            // Hide the table and display the empty compare message
            heartTable.style.display = "none";
            messageElement.style.display = "block";
        } else {
            // Show the table and hide the empty compare message
            heartTable.style.display = "table";
            messageElement.style.display = "none";
        }
    }
    checkEmptyHeart();
    function viewed_heart() {
        if (localStorage.getItem('heart') != null) {
            var data = JSON.parse(localStorage.getItem('heart'));
            for (i = 0; i < data.length; i++) {
                console.log("first")
                var name = data[i].name;
                var priceSale = data[i].priceSale;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                var id = data[i].id;
                var heartImageElement = document.getElementById("Myheart_" + id);
                if (heartImageElement) {
                    heartImageElement.src = data[i].imageSrc;
                }

                $('#row_heart').find('tbody').append(`
                <tr id="row_heart` + id + `"> 
                    <td><img width=100 src="` + image + `"alt=""></td>
                    <td class="name-product">` + name + `</td>
                    <td class="text-center">   <span class="format-currency">` + priceSale +
                    `đ</span><del><span class="format-currency">` + price + `đ</span></del></td>
                    <td><a href="` + url + `" class="btn btn-secondary"><img width=20 src="{{ asset('storage/img/icon/cart-shopping-solid.svg') }}"
                alt=""></a>
                        <a onclick="delete_heart(` + id + `)" class="btn btn-danger"><img width=20 src="{{ asset('storage/img/icon/trash-solid.svg') }}"
                alt=""></a>
                        </td>
                </tr>
                `);
            }
            checkEmptyHeart();
        }
    }


    function add_heart(product_id) {
        var id = product_id;
        var name = document.getElementById('wishlist_name' + id).value;
        var priceSale = document.getElementById('wishlist_pricesale' + id).value;
        var price = document.getElementById('wishlist_price' + id).value;
        var image = document.getElementById('wishlist_image' + id).value;
        var url = document.getElementById('wishlist_url' + id).value;
        var newItem = {
            'url': url,
            'id': id,
            'name': name,
            'priceSale': priceSale,
            'price': price,
            'image': image
        }
        if (localStorage.getItem('heart') == null) {
            localStorage.setItem('heart', '[]');

        }
        var old_data = JSON.parse(localStorage.getItem('heart'));

        var matches = $.grep(old_data, function(odj) {
            return odj.id == id;
        });
        if (matches.length) {
            matches[0].imageSrc = "{{ asset('storage/img/icon/heart.png') }}";
            document.getElementById("Myheart_" + id).src = matches[0].imageSrc;
            delete_heart(id);
        } else {
            newItem.imageSrc = "{{ asset('storage/img/icon/heart-solid.svg') }}";
            document.getElementById("Myheart_" + id).src = newItem.imageSrc;
            old_data.push(newItem);
            var formatpriceSale = formatCurrency(newItem.priceSale);
            var formatprice = formatCurrency(newItem.price);

            $('#row_heart').find('tbody').append(`
                <tr id="row_heart` + id + `"> 
                    <td><img width=100 src="` + newItem.image + `"alt=""></td>
                    <td class="name-product">` + newItem.name + `</td>
                    <td class="text-center"> <span class="format-currency">` +  formatpriceSale +
                `</span><del><span class="format-currency">` + formatprice + `</span></del></td>
                    <td><a href="` + newItem.url + `" class="btn btn-secondary"><img width=20 src="{{ asset('storage/img/icon/cart-shopping-solid.svg') }}"
                alt=""></a>
                        <a onclick="delete_heart(` + id + `)" class="btn btn-danger"><img width=20 src="{{ asset('storage/img/icon/trash-solid.svg') }}"
                alt=""></a>
                        </td>
                </tr>
                `);

            localStorage.setItem('heart', JSON.stringify(old_data));
            checkEmptyHeart();
        }


    }
</script>
