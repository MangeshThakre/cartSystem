$(document).ready(function(){

    $(".user-id").click(function(){
      var id= $(this).attr('data-id');
      var title=$(this).attr('data-title');
      var price=$(this).attr('data-price');
      var category=$(this).attr('data-category');
      var userId=$(this).attr('user-id');
        var link=window.location.href+'account'
        if (userId===''){
        window.location.replace(link);

        }else{
          $.ajax({
            type:'POST',
            url:'cartpost',
            data:{product_id:id,user_title:title,user_price:price,user_category:category},
            success: function(data) {
                var total_item=data.total_item;
  
      $('.cart').html(`cart: ${total_item}`);
    
      alert('item added')
          
          }
        });
        }



    });

////////// sub//////////////////
    $(".Psub").click(function(){
    var product_id=$(this).attr('product_id')
    $.ajax({
      type:'POST',
      url:'sub',
      data:{product_id:product_id},
      success: function(data){
        var total_item=data.total_item;
        // console.log(total_item);
        var count=data.count;
        var total=data.total_price;
        var dataa=data.dataaa;        
        if(dataa==1){
          $(`.count${product_id}`).html(`count:${count}`);
          $(`.total_price${product_id}`).html(`${total}`);
        }else{
          $(`.remove${product_id}`).remove();
        }
        $('.cart').html(`cart: ${total_item}`);

        if(total_item==0){
          $('#buy').html(`<h1>Empty cart</h1>`);
        }else{
        $('#buy').html(`<button type="button" class="btn btn-primary">buy</button>`)

        }
      }
    })
// count();

      });
      
// /////// adddd/////////
$(".Padd").click(function(){
  var product_id=$(this).attr('product_id');
  $.ajax({
    type:'POST',
    url:'add',
    data:{product_id:product_id},
    success:function(data){  
      // console.log(data);
       var total_item = data.total_item;    
      var count= data.count;
      var total=data.total_price;
      $(`.count${product_id}`).html(`count:${count}`);
      $(`.total_price${product_id}`).html(`${total}`);
      $('.cart').html(`cart: ${total_item}`);

    }
  });
// count();

});

//////////remove////////
$(".remove").click(function(){
  var product_id=$(this).attr('product_id')
  $.ajax({
      type:'POST',
      url:'remove',
      data:{product_id:product_id},
      success:function(data){
    var total_item=data.total_item
    $('.cart').html(`cart: ${total_item}`);
    if(total_item==0){
    $("#buy").html('<h1>Empty cart</h1>');
    }else{
      $('#cart').html(`<button type="button" class="btn btn-primary">buy</button>`);
    }

      $(`.remove${product_id}`).remove();
    }
  })


})


count();

function count() {
$.ajax({
  type:'GET',
  url:'count',
  success:function(data){

    var total_item=data.total_item;
    $('.cart').html(`cart: ${total_item}`);
    if(total_item!=0){
    $("#buy").html(`<button type="button" class="btn btn-primary">buy</button>`);
    }else{
        $('#buy').html("<h1>Empty cart</h1>");
        
    }
  }
})
}

  $("#buy").click(function(){
    $('.bill').show();
    $.ajax({
      type:'GET',
      url:'buy',
      success:function(data){
        var html=''
        let cart=data.cart_data
        let total_price=data.total_price;
        // console.log(total_price);
         for (const cart_data of cart){
          html+=`<p>title:${cart_data.title}</p>`;
          html+=`<p>category:${cart_data.category}</p>`
          html+=`<p>price/item:<b>${cart_data.price}Rs</b> quantity:<b>${cart_data.item_count}</b></p>`;
          html+=`<p>price:${cart_data.total_price}</p>`
          html+=`<hr>`
         
           }
          
            $('.bill').html(`<div class='card  bg-dark text-white'
          style=' position:fixed;
          margin-top:5rem;
          margin-left:33rem;
          z-index:99999;
          height:20rem;
          width: 30rem ;
          border-radius:5px;
          overflow-y:scroll;
          box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
          '
          > 
          <div><h1>conform Order!</h1><hr></div>
          <div class='container'>${html}</div>
          
          <div>
          <p>total Price: <b>${total_price}Rs</b> </p>
          <span type="button" class="btn btn-primary" id="cancel" >cancel</span>
          <span type="button" class="btn btn-primary  my-3" id="order">conform order</span>
          </div>
          </div>`)
        
      }

    })

    
   });


   $(document).on('click',"#cancel",function(){
    $('.bill').hide();
});

$(document).on('click',"#order",function(){
  alert('order successful')
   $.ajax({
     type:'GET',
     url:'order',
     success:function(data){
    $('.bill').hide();  
    console.log(data); 
     }
   })

  })


  $(".orderid").click(function(){
    alert("The paragraph was clicked.");
  });




  });
