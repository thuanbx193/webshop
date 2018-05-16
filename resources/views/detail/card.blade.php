@extends('layouts.new-master')
@section('content')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home" style="color:#FFF;font-size: 18px;"><a href="{!!url('/')!!}" title="" style="color:#FFF; text-decoration: none; "> Home</a></span> 
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 18px; color:#FFF; margin-left:5px; margin-right:5px"></span><a href="#" title="" style="color:#FFF;text-decoration: none; ">Orders</a>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 18px; color:#FFF; margin-left:5px; margin-right:5px"></span> <a href="#" title="" style="color:#FFF;text-decor;text-decoration: none; ">{!!$slug!!}</a>
    </h3>              
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">              
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="margin-top:20px; ">
          <div class="panel panel-success" style="min-height: 1760px;background-color:rgba(255,255,255,0.1); color:#FFF;  border-color:rgba(255,255,255,0.1);">
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
            </div>
            @elseif (Session()->has('flash_level'))
              <div class="alert alert-success">
                  <ul>
                      {!! Session::get('flash_massage') !!} 
                  </ul>
              </div>
          @endif
            <div class="panel-body">
              <div class="table-responsive" >
                <table class="table table-hover" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Product</th>
                      <th>Amount</th>
                      <th>Action</th>
                      <th>Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach(Cart::content() as $row)
                    <tr style="background-color:transparent;">
                      <td>{!!$row->id!!}</td>
                      <td><img src="{!!url('uploads/products/'.$row->options->img)!!}" alt="dell" width="80" height="56"></td>
                      <td>{!!$row->name!!}</td>
                      <td class="text-center" height="59" style="padding-top:20pxbackground-color:rgba(255,255,255,0.1);" width="100">                         
                          @if (($row->qty) >1)
                          <a href="{!!url('gio-hang/update/'.$row->rowId.'/'.$row->qty.'-down')!!}"><span class="glyphicon glyphicon-minus" ></span></a> 
                          @else
                            <a href="#" style="color:#FFF"><span class="glyphicon glyphicon-minus" style="color:#FFF;"></span></a> 
                          @endif
                          <input type="text" class="qty text-center" value=" {!!$row->qty!!}" style="width:35px; font-weight:bold; font-size:16px; color:#000; height:40px" readonly="readonly"> 
                        <a href="{!!url('gio-hang/update/'.$row->rowId.'/'.$row->qty.'-up')!!}"><span class="glyphicon glyphicon-plus-sign" style="color: #FFF" ></span></a>
                      </td>
                      <td><a href="{!!url('gio-hang/delete/'.$row->rowId)!!}" onclick="return xacnhan('Remove this product ?')" ><span class="glyphicon glyphicon-remove" style="padding-top:20px; font-size:16px; color:#FFF"></span></a></td>
                      <td>{!! number_format($row->price) !!} VND</td>
                      <td>{!! number_format($row->qty * $row->price) !!} VND</td>
                    </tr>
                  @endforeach                    
                    <tr style="background-color:transparent;">
                      <td colspan="3"><strong>Total :</strong> </td>
                      <td>{!!Cart::count()!!}</td>
                      <td colspan="2" style="color:#FFF;">{!!Cart::subtotal()!!} VND</td>                      
                    </tr>                    
                  </tbody>
                </table>                
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 no-paddng">
              @if(Cart::count() !=0)
                @if (Auth::guest())
					<div>
                  <div class="input-group" style="float:left">
                      <select name="paymethod" id="inputPaymethod" class="form-control" required="required" style="background-color:#7D7D7D;color:#000; border-color:transparent;">
                        <option value="cod">COD (Pay when receive product)</option>
                        <option value="paypal">Paypal (Pay by Paypal)</option>                      
                      </select>
                  </div>
                  <a class="btn btn-large btn-warning pull-right" href="{!!url('/login')!!}" style="background-color:#7D7D7D;color:#000; border-color:transparent;float:left" >PAY</a>
				  </div>
                @else
                  <form action="{!!url('/dat-hang')!!}" method="get" accept-charset="utf-8">                    
                    <div class="input-group">
                    <label for="paymethod">Choose Payment Methods</label>
                      <select name="paymethod" id="inputPaymethod" class="form-control" required="required">
                        <option value="">Choose Methods</option> 
                        <option value="paypal">Paypal</option> 
                        <option value="cod">COD</option>
                      </select>
                    </div>
                    <hr>
                      <button type="submit" class="btn btn-danger pull-right" style="background-color:#7D7D7D;color:#000; border-color:transparent;">Pay</button>
                      <a href="{!!url('/')!!}" type="button" class="btn btn-large btn-primary pull-left" style="background-color:#7D7D7D;color:#000; border-color:transparent;">Continue</a>
                  </form>
                @endif
              @endif
              </div>
              <hr>
            </div>
          </div>   
        </div>
      </div>     
    </div> 
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">            
      <!-- panel inffo 1 -->
      <div class="panel panel-info" style="background-color:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.1)">
        <div class="panel-heading" style="background-color:rgba(255,255,255,0.1);border-color:rgba(255,255,255,0.1);color:#BFBFBF;">
          <h3 class="panel-title text-center"  >NEWEST ARRIVALS</h3>
        </div>
        <div class="panel-body no-padding" >
        <?php 
          $sneaker = DB::table('products')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
                ->where('category.parent_id','=','1')
                ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
                ->orderBy('products.created_at', 'desc')
                ->paginate(2); 

        ?>
        @foreach($sneaker as $row)
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding" >
            <div class="thumbnail mobile" style="background-color:transparent; border-color:transparent; color:#BFBFBF; height:750px;">              
              <div class="bt">
                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('uploads/products/'.$row->images)!!}" alt="{!!$row->name!!}">
                </div>
                <div class="intro pull-right"style="width:100%;padding-right:5px;font-size:15px;">
                  <h1><small class="title-mobile">{!!$row->name!!}</small></h1>
                  <li>{!!$row->intro!!}</li>
				  
                </div><!-- /div introl -->
              </div> <!-- /div bt -->
               <div class="ct" style="padding-left:5px;padding-right:5px; font-size:18px">
				<div style="float:left;width:40%;margin-top:20px; font-size:18px">
					<span class="label label-info" style="background-color:transparent; border-width:0.1px; border:solid; color:#BFBFBF">Size</span>   
					<div>
                    <li style="font-size:15px"><span class="glyphicon glyphicon-ok-sign" style="padding-top:10px;margin-right: 5px;"></span>{!!$row->promo1!!}</li>
                    <li style="font-size:15px"><span class="glyphicon glyphicon-ok-sign" style="padding-top:10px;margin-right:5px"></span>{!!$row->promo2!!}</li>
                    <li style="font-size:15px"><span class="glyphicon glyphicon-ok-sign" style="padding-top:10px;margin-right:5px"></span>{!!$row->promo3!!}</li>
					</div>
				  </div>
                <a href="{!!url('sneaker/'.$row->id.'-'.$row->slug)!!}" title="More Information" style="color:#BFBFBF; text-decoration: none; float: left;margin-top:20px">
                  <span class="label label-info" style="margin-top:10px; background-color:transparent; border-width:0.1px; border:solid;color:#BFBFBF">Quality</span>   
                    <li style="font-size:15px;padding-bottom:5px"><span class="glyphicon glyphicon-ok-sign" style="padding-top:10px;margin-right:5px;color:#BFBFBF; font-weight:bold"></span>riginal</li> 
                  <span class="label label-warning" style=" border-width:1px; border:solid;background-color:transparent;color:#BFBFBF">More Information</span> 
                </a>
              </div>
                <span class="btn label-warning" style="position: absolute; bottom: 30px; left:30px; border-width:0.1px; border:solid;background-color:#7D7D7D; color:#000;border-color:#404040 "><strong>{!!number_format($row->price)!!}</strong>VND</span>
                <a href="{!!url('gio-hang/addcart/'.$row->id)!!}" class="btn btn-success pull-right add" style="position: absolute;background-color:#7D7D7D;color:#000; bottom: 30px; right:30px; border-width:0.1px; border:solid; border-color:#404040; font-weight:bold">Add to Cart </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
        @endforeach        

        </div>
      </div> <!-- /panel info 2  quản cáo 1          -->
      
    <!-- panel info 2  quản cáo 1          -->          
    <div class="panel panel-info" style="background-color:transparent; color:#BFBFBF; border-color:rgba(255,255,255,0.2)">
      <div class="panel-heading" style="background-color:transparent; color:#BFBFBF; border-color:#transparent">
        <h3 class="panel-title text-center">HOT EVENTS</h3>
      </div>
      <div class="panel-body no-padding">
       <a href="#" title=""><img src="{!!url('images/slides/thumbs/qc1.png')!!}" alt="" width="100%" height="100%"> </a> <br>
        <a href="#" title=""><img src="{!!url('images/slides/thumbs/qc2.png')!!}" alt="" width="100%" height="100%"> </a> <br>
        <a href="#" title=""><img src="{!!url('images/slides/thumbs/qc3.png')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('images/slides/thumbs/qc4.png')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('images/slides/thumbs/qc5.png')!!}" alt="" width="100%" height="100%"> </a>
      </div>
    </div> <!-- /panel info 2  quản cáo 1          -->        
    <div class="panel panel-info"  style="background-color:transparent; color:#BFBFBF; border-color:rgba(255,255,255,0.2)">
      <div class="panel-heading" style="background-color:transparent; color:#BFBFBF; border-color:#transparent">
        <h3 class="panel-title">INFO</h3>
      </div>
      <div class="panel-body">
        <p>Articles: 172</p>
        <p>Members : 26</p>
        <p>Online Members: 8</p>
        <p>Guest : 435</p>
      </div>
    </div>
     <!-- /panel info 2  quản cáo 1          -->  
     <!-- fan pages myweb -->
    <div class="panel panel-info"  style="background-color:transparent; color:#BFBFBF; border-color:rgba(255,255,255,0.2)">
      <div class="panel-heading" style="background-color:transparent; color:#BFBFBF; border-color:#transparent">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Like <a href="https://www.facebook.com/pnl.archenemy" title=""> PrimeGallery </a> to update information
      </div>
    </div> <!-- /fan pages myweb -->        
  </div> 
</div>
<!-- ===================================================================================/news ============================== -->
@endsection