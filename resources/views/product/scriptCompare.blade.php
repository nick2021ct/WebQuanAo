<script>
    function delete_compare(id) {
        if (localStorage.getItem('compare') != null) {
            var data = JSON.parse(localStorage.getItem('compare'));
            var index = data.findIndex(item => item.id === id);
            data.splice(index, 1);
            localStorage.setItem('compare', JSON.stringify(data));
            document.getElementById("row_compare" + id).remove();

            checkEmptyCompare();
        }
    }
    viewed_compare();

    function checkEmptyCompare() {
        var compareTable = document.getElementById("row_compare");
        var messageElement = document.getElementById("empty_compare_message");

        if (compareTable != null && compareTable.rows.length <= 1) {
            // Hide the table and display the empty compare message
            compareTable.style.display = "none";
            messageElement.style.display = "block";
        } else {
            // Show the table and hide the empty compare message
            compareTable.style.display = "table";
            messageElement.style.display = "none";
        }
    }

    function viewed_compare() {
        if (localStorage.getItem('compare') != null) {
            var data = JSON.parse(localStorage.getItem('compare'));

            for (i = 0; i < data.length; i++) {
                var name = data[i].name;
                var priceSale = data[i].priceSale;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                var id = data[i].id;
                $('#row_compare').find('tbody').append(`
                <tr id="row_compare` + id + `"> 
                    <td class="name-product text-center">` + name + `</td>
                    <td class="text-center">   <span class="format-currency">` + priceSale +
                    `đ</span><del><span class="format-currency">` + price + `đ</span></del></td>
                    <td class="text-center"><img width=100 src="` + image + `"alt=""></td>
                    <td class="text-center"><a href="` + url + `" class="btn btn-outline-dark"><img width=20 src="{{ asset('storage/img/icon/circle-info-solid.svg') }}"
                alt=""></a>
                        <a onclick="delete_compare(` + id + `)" class="btn btn-danger"><img width=20 src="{{ asset('storage/img/icon/trash-solid.svg') }}"
                alt=""></a>
                        </td>

                </tr>
                `);
            }
            checkEmptyCompare();
        }
    }

    function add_compare(product_id) {
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
        if (localStorage.getItem('compare') == null) {
            localStorage.setItem('compare', '[]');

        }
        var old_data = JSON.parse(localStorage.getItem('compare'));

        var matches = $.grep(old_data, function(odj) {
            return odj.id == id;
        });
        if (matches.length) {

        } else {

            if (old_data.length < 4) {
                var formatpriceSale = formatCurrency(newItem.priceSale);
                var formatprice = formatCurrency(newItem.price);
                old_data.push(newItem);
                $('#row_compare').find('tbody').append(`
                <tr id="row_compare` + id + `"> 
                    <td class="name-product text-center">` + newItem.name + `</td>
                    <td class="text-center">   <span class="format-currency">` + formatpriceSale +
                    `</span><del><span class="format-currency">` + formatprice + `</span></del></td>
                    <td class="text-center"><img width=100 src="` + newItem.image + `"alt=""></td>
                    <td class="text-center"><a href="` + newItem.url + `" class="btn btn-outline-dark"><img width=20 src="{{ asset('storage/img/icon/circle-info-solid.svg') }}"
                alt=""></a>
                        <a onclick="delete_compare(` + id + `)" class="btn btn-danger"><img width=20 src="{{ asset('storage/img/icon/trash-solid.svg') }}"
                alt=""></a>
                        </td>
                </tr>
                `);
            }
        }
        localStorage.setItem('compare', JSON.stringify(old_data));
        checkEmptyCompare();
    }
</script>
