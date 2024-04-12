<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List with View Button</title>
    <style>
        /* Bold text by default */
        .list-item {
            font-weight: bold;
        }

        /* Lighter text when viewed */
        .list-item.viewed {
            font-weight: lighter;
        }
    </style>
</head>
<body>

<h2>List of Items</h2>

<ul>
    <li class="list-item" id="item1">
        Item 1
        <button onclick="viewItem(this, 'item1')">View</button>
    </li>
    <li class="list-item" id="item2">
        Item 2
        <button onclick="viewItem(this, 'item2')">View</button>
    </li>
    <li class="list-item" id="item3">
        Item 3
        <button onclick="viewItem(this, 'item3')">View</button>
    </li>
</ul>

<script>
    // Check if item was previously viewed and update its style accordingly
    ['item1', 'item2', 'item3'].forEach(itemId => {
        var viewed = localStorage.getItem(itemId);
        if (viewed) {
            document.getElementById(itemId).classList.add('viewed');
        }
    });

    // Function to mark an item as viewed
    function viewItem(button, itemId) {
        // Check if item already viewed
        if (!localStorage.getItem(itemId)) {
            // Mark item as viewed
            localStorage.setItem(itemId, true);

            // Get the parent list item
            var listItem = button.parentNode;

            // Add the "viewed" class to the parent list item
            listItem.classList.add('viewed');

            // Get the text of the list item
            var itemText = listItem.textContent.trim();

            // Redirect to another page with the item text as a query parameter
            window.location.href = 'other_page.php?item=' + encodeURIComponent(itemText);
        }
    }
</script>

</body>
</html>
