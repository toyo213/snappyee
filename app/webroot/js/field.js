var ItemField = {
    currentNumber : 1,
    itemTemplate : '<h3>項目__count__<h3/>'
        + '<p><input type="text" name="text__count__" size="30" /></p>',
    add : function () {
        this.currentNumber++;

        var field = document.getElementById('item' + this.currentNumber);

        var newItem = this.itemTemplate.replace(/__count__/mg, this.currentNumber);
        field.innerHTML = newItem;

        var nextNumber = this.currentNumber + 1;
        var new_area = document.createElement("div");
        new_area.setAttribute("id", "item" + nextNumber);
        field.appendChild(new_area);
    },
    remove : function () {
        if ( this.currentNumber == 1 ) { return; }

        var field = document.getElementById('item' + this.currentNumber);
        field.removeChild(field.lastChild);
        field.innerHTML = '';

        this.currentNumber--;
    }
}