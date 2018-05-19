<div class="container">
    <div class="row">
        <div class="col-sm-4 sex-watches">
            <div class="col-xs-12 content_item_watch">
                <a href="./dong-ho-nam">
                    <img src="./public/images/icon/men.jpg" alt="" class="img img-responsive">
                    <div class="title_item_sex_watch">
                        <p>NAM</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-4 sex-watches">
           <div class="col-xs-12 content_item_watch">
               <a href="./dong-ho-nu">
                   <img src="./public/images/icon/ladies.jpg" alt="" class="img img-responsive">
                   <div class="title_item_sex_watch">
                       <p>NỮ</p>
                   </div>
               </a>
           </div>
        </div>
        <div class="col-sm-4 sex-watches">
            <div class="col-xs-12 content_item_watch">
                <a href="./dong-ho-unisex">
                    <img src="./public/images/icon/unisex.jpg" alt="" class="img img-responsive">
                    <div class="title_item_sex_watch">
                        <p>UNISEX</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row list_hot_brand">
        <ul>
            <?php
            foreach ($arr['list_brands'] as $brands){
                echo "<a href='./dong-ho/".$brands['alias_brand']."'><li>".$brands['name_brand']."</li></a>";
            }
            ?>
        </ul>
    </div>
</div>