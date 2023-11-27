
    let subtotals = {}; // Objeto para almacenar los subtotales de cada producto

    window.onload = function () {
        // Fetch quantities and prices from the server (PHP session)
        $.ajax({
            url: 'get_cart_data.php',
            method: 'GET',
            success: function (data) {
            console.log(data);
                  let va=JSON.parse(data);
                  console.log(va);
                  var quantities = va.quantities;  // Accede a las propiedades en va, no en data
                  var prices = va.prices;
                  console.log(quantities);
                // Initialize subtotals based on quantities and prices
                 subtotals = {};
                for (var productName in quantities) {
                    var quantity = quantities[productName];
                    var price = prices[productName];
                    var subtotal = quantity * price;
    
                    subtotals[productName] = subtotal;
    
                    // Update the corresponding subtotal cell for the product on page load
                    $(".subtotal[data-product-name='" + productName + "']").text(subtotal + ' €');
                }
    
                // Calculate the total based on retrieved subtotals
                total(subtotals);
            },
            error: function () {
                console.log('Error fetching cart data');
            }
        });
    };
    function updateCartItem(productName, productPrice, inputElement) {
        var quantity = $(inputElement).val();

        if (quantity <= 0) {
            quantity = 1;
        }

        var subtotal = productPrice * quantity;


        subtotals[productName] = subtotal;
        console.log(subtotals);
        total(subtotals);
        // Update the corresponding subtotal cell for the product
        $(".subtotal[data-product-name='" + productName + "']").text(subtotal + ' €');


        
            $.ajax({
                type: "POST",
                url: "updateproduct.php",
                data: {
                    action: "updateCartItem",
                    name: productName,
                    value: inputElement.value
                },
                success: function(data) {
                    if (data === 'ok') {
                        // Encuentra el input específico y actualiza su valor
                        $("input[data-product-name='" + productName + "']").val(inputElement.value);
                    } else {
                        alert('Failed to update item. Please try again.');
                    }
                },
                error: function() {
                    alert('Error in Ajax request.');
                }
            });
        
        
    }


    function removeCartItem(productName) {
        var confirmation = confirm('Are you sure you want to remove this item?');
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "deleteproduct.php",
                data: {
                    action: "removeCartItem",
                    name: productName
                },
                success: function(data) {
                    if (data === 'ok') {
                        alert('Item removed successfully.');
                        delete subtotals[productName];
                        total(subtotals)
                        $(".product-row[data-product-name='" + productName + "']").remove();

                    } else {
                        alert('Failed to remove item. Please try again.');
                    }
                },
                error: function() {
                    alert('Error in Ajax request.');
                }
            });
        }
    }


    function total(subtotal) {
        let subtotalsArray = Object.values(subtotals); // Obtener un array de subtotales
        let newTotal = 0;

        for (let subtotal of subtotalsArray) {
            newTotal += subtotal; // Sumar cada subtotal al nuevo total
        }

        // Ahora, newTotal contiene la suma de todos los subtotales
        $("#total").text('Total ' + newTotal + ' €'); // Actualizar el elemento HTML con el nuevo total
    }

    function openModal() {
        document.getElementById("modal").style.display = "block";
        document.getElementById("overlay").style.display = "block";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
        document.getElementById("overlay").style.display = "none";
    }

    function confirmAction() {
        // Aquí puedes agregar la lógica de PHP para confirmar la acción
        closeModal();
    }

    function cancelAction() {
        // Aquí puedes agregar la lógica de PHP para cancelar la acción
        closeModal();
    }

