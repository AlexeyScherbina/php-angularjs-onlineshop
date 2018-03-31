app.service('cartService', function() {
    this.products = [];

    this.addProduct = function(prod){
      var b = true;
      for(var i = 0; i < this.products.length; i++){
        if(this.products[i].ProductID == prod.ProductID){
          this.products[i].count +=1;
          b = false;
        }
      }
      if(b == true){
        prod.count = 1;
        this.products.push(prod);
      }
    }

    this.getTotal = function(){
      var sum = 0;
      for(var i = 0; i < this.products.length; i++){
        sum += this.products[i].ProductPrice * this.products[i].count;
      }
      return sum;
    }
});