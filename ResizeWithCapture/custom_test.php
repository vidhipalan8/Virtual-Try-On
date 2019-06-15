
<!DOCTYPE html>
<html>
<head>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/konva.min.js"></script>
  <meta charset="utf-8">
  <title>Image Resize Demo</title>
 
</head>
<script type="text/javascript">
	// $(function(){
	// 	$("#maindiv").load("script.php");
	// })
</script>
<body>


        <body>
        <div id="maindiv">
            <div id="formdiv">

                <a href="test1.php">CaptureImage</a>
                <form enctype="multipart/form-data" action="" method="post">
                   <table>
                    <thead>
                        <tr>
                            <th>File</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div id="filediv">
                                    <input name="file[]" type="file" id="file" />
                                </div>
                                <!-- <input type="button" id="add_more" class="upload" value="Add More Files" /> -->
                            </td>
                            
                        </tr>
                        <!-- <tr>
                            <td>
                                <input type="submit" value="Upload File" name="submit" id="upload" class="upload" />
                            </td>
                        </tr> -->
                    </tbody>
                   </table>
                    
                    
                </form>
                    <img src="photo.png"  style= " width:32% ; position: absolute;margin: 181px 282px;height:450px">
                    

                <div style="margin-left: 300px">
                    <button onclick="getfilename(this.value)" value="1.png">
                        <img src="assets/images/1.png"  style= " width:100px ;">
                    </button>
                    <button onclick="getfilename(this.value)" value="2.png">
                    <img src="assets/images/2.png"  style= " width:100px ;">
                    </button>
                    <button onclick="getfilename(this.value)" value="3.png">
                    <img src="assets/images/3.png"  style= " width:100px ;">
                    </button>
                    <button onclick="getfilename(this.value)" value="4.png">
                    <img src="assets/images/4.png"  style= " width:100px ;">
                    </button>
                </div>    
            </div>
        </div>
    </body>



<script type="text/javascript">
    
    var abc = 0; // Declaring and defining global increment variable.
    $(document).ready(function() {
        //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
        $('#add_more').click(function() {
            $(this).before($("<div/>", {
                id: 'filediv'
            }).fadeIn('slow').append($("<input/>", {
                name: 'file[]',
                type: 'file',
                id: 'file'
            }), $("<br/><br/>")));
        });
        // Following function will executes on change event of file input to select different file.
        $('body').on('change', '#file', function() {
            if (this.files && this.files[0]) {
                abc += 1; // Incrementing global variable by 1.
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                // $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' width='200px'/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd" + abc).append($("<img/>", {
                    id: 'img',
                    src: 'Delete_Icon.png',
                    alt: 'delete',
                    style:'width:25px'
                }).click(function() {
                    $(this).parent().parent().remove();
                }));
            }
        });
        // To Preview Image
        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        };
        $('#upload').click(function(e) {
            var name = $(":file").val();
            if (!name) {
                alert("First Image Must Be Selected");
                e.preventDefault();
            }
        });
    });

</script>


  <div id="container"></div>
  <script>
    var width = window.innerWidth;
    var height = window.innerHeight;

    function update(activeAnchor) {
        var group = activeAnchor.getParent();

        var topLeft = group.get('.topLeft')[0];
        var topRight = group.get('.topRight')[0];
        var bottomRight = group.get('.bottomRight')[0];
        var bottomLeft = group.get('.bottomLeft')[0];
        var image = group.get('Image')[0];

        var anchorX = activeAnchor.getX();
        var anchorY = activeAnchor.getY();

        // update anchor positions
        switch (activeAnchor.getName()) {
            case 'topLeft':
                topRight.setY(anchorY);
                bottomLeft.setX(anchorX);
                break;
            case 'topRight':
                topLeft.setY(anchorY);
                bottomRight.setX(anchorX);
                break;
            case 'bottomRight':
                bottomLeft.setY(anchorY);
                topRight.setX(anchorX);
                break;
            case 'bottomLeft':
                bottomRight.setY(anchorY);
                topLeft.setX(anchorX);
                break;
        }

        image.position(topLeft.position());

        var width = topRight.getX() - topLeft.getX();
        var height = bottomLeft.getY() - topLeft.getY();
        if(width && height) {
            image.width(width);
            image.height(height);
        }
    }
    function addAnchor(group, x, y, name) {
        var stage = group.getStage();
        var layer = group.getLayer();

        var anchor = new Konva.Circle({
            x: x,
            y: y,
            stroke: '#666',
            fill: '#ddd',
            strokeWidth: 2,
            radius: 8,
            name: name,
            draggable: true,
            dragOnTop: false
        });

        anchor.on('dragmove', function() {
            update(this);
            layer.draw();
        });
        anchor.on('mousedown touchstart', function() {
            group.setDraggable(false);
            this.moveToTop();
        });
        anchor.on('dragend', function() {
            group.setDraggable(true);
            layer.draw();
        });
        // add hover styling
        anchor.on('mouseover', function() {
            var layer = this.getLayer();
            document.body.style.cursor = 'pointer';
            this.setStrokeWidth(4);
            layer.draw();
        });
        anchor.on('mouseout', function() {
            var layer = this.getLayer();
            document.body.style.cursor = 'default';
            this.setStrokeWidth(2);
            layer.draw();
        });

        group.add(anchor);
    }

    var stage = new Konva.Stage({
        container: 'container',
        width: width,
        height: height
    });

    var layer = new Konva.Layer();
    stage.add(layer);

    // darth vader
    var darthVaderImg = new Konva.Image({
        width: 500,
        height: 450
    });

    // yoda
    var yodaImg = new Konva.Image({
        width: 420,
        height: 380
    });

    var darthVaderGroup = new Konva.Group({
        x: 280,
        y: 50,
        draggable: true
    });
    layer.add(darthVaderGroup);
    darthVaderGroup.add(darthVaderImg);
    // addAnchor(darthVaderGroup, 0, 0, 'topLeft');
    // addAnchor(darthVaderGroup, 500, 0, 'topRight');
    // addAnchor(darthVaderGroup, 500, 450, 'bottomRight');
    // addAnchor(darthVaderGroup, 0, 450, 'bottomLeft');

    var yodaGroup = new Konva.Group({
        x: 300,
        y: 140,
        draggable: true
    });
    layer.add(yodaGroup);
    yodaGroup.add(yodaImg);
    addAnchor(yodaGroup, 00, 00, 'topLeft');
    addAnchor(yodaGroup, 420, 00, 'topRight');
    addAnchor(yodaGroup, 420, 370, 'bottomRight');
    addAnchor(yodaGroup, 00, 370, 'bottomLeft');

    var imageObj1 = new Image();
    imageObj1.onload = function() {
        darthVaderImg.image(imageObj1);
        layer.draw();
    };




     var imageForBg = '5.jpeg';
     var funcOne = $('input[type="file"]').change(function(e){
            imageForBg = e.target.files[0].name;
     imageObj1.src = imageForBg;
     });


     //    if ($('input[type="file"]')) {


     // }else{
     //    imageForBg = '2.jpg';
     // }
// alert(imageForBg);
var MyApp = {};    
function getfilename(e){
        // alert(e);
    var imageObj2 = new Image();
    imageObj2.onload = function() {
        yodaImg.image(imageObj2);
        layer.draw();
    };
    imageObj2.src = 'assets/images/'+e;
}
  </script>

</body>
</html>
