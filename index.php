<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hidden-input'])) {
  $imgurl = $_POST['hidden-input'];
  $ch = curl_init($imgurl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $download = curl_exec($ch);
  curl_close($ch);
  header('Content-type: image/jpeg');
  header('Content-Disposition: attachment; filename="thumbnail.jpeg"');
  echo $download;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thumbnail downloader</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <main>
      <section>
        <h1 id="title">Download Thumbnail</h1>
        <div id="contform">
          <p>Paste video url</p>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <input
            type="text"
            name="url"
            id="urlform"
            placeholder="Ex: https://www.youtube.com/watch?v=dQw4w9WgXcQ"
          />
        </div>
        <div id="preview">
          <svg
            id="cloudsvg"
            viewBox="0 -4 32 32"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
            fill="#000000"
          >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
              id="SVGRepo_tracerCarrier"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
              <title>cloud-upload</title>
              <desc>Created with Sketch Beta.</desc>
              <defs></defs>
              <g
                id="Page-1"
                stroke="none"
                stroke-width="1"
                fill="none"
                fill-rule="evenodd"
                sketch:type="MSPage"
              >
                <g
                  id="Icon-Set-Filled"
                  sketch:type="MSLayerGroup"
                  transform="translate(-466.000000, -1144.000000)"
                  fill="#3282B8"
                >
                  <path
                    d="M488.718,1157.61 C488.325,1158 487.688,1158 487.295,1157.61 L483,1153.34 L483,1162.99 C483,1163.54 482.553,1163.99 482,1163.99 C481.447,1163.99 481,1163.54 481,1162.99 L481,1153.37 L476.736,1157.61 C476.344,1158 475.707,1158 475.313,1157.61 C474.921,1157.22 474.921,1156.59 475.313,1156.19 L481.254,1150.28 C481.464,1150.07 481.741,1149.98 482.016,1150 C482.29,1149.98 482.568,1150.07 482.777,1150.28 L488.718,1156.19 C489.11,1156.59 489.11,1157.22 488.718,1157.61 L488.718,1157.61 Z M489.067,1149.03 C487.599,1146.05 484.543,1144 481,1144 C476.251,1144 472.37,1147.68 472.033,1152.34 C468.542,1153.34 466,1156.39 466,1160 C466,1164.26 469.54,1167.73 474,1167.98 L491,1168 C494.437,1166.51 498,1162.35 498,1158.5 C498,1153.45 494.049,1149.32 489.067,1149.03 L489.067,1149.03 Z"
                    id="cloud-upload"
                    sketch:type="MSShapeGroup"
                  ></path>
                </g>
              </g>
            </g>
          </svg>
          <input type="hidden" name="hidden-input" id="hidden-input">
          <p>paste video url to see preview</p>
          <img id="imgpreview" src="" alt="" />
        </div>
        <input type="submit" value="Download Thumbnail" name="download" />
        </form>
      </section>
    </main>
  </body>
  <script>
    const urlfield = document.getElementById("urlform"),
      previewarea = document.getElementById("preview"),
      imgtag = document.getElementById("imgpreview"),
      hiddenimp = document.getElementById("hidden-input");

    urlfield.oninput = () => {

      let imgurl = urlfield.value;
      previewarea.classList.add("active");

      if (imgurl.indexOf("https://www.youtube.com/watch?v=") != -1) {

        let vidID = imgurl.split("v=")[1].substring(0, 11);
        let ytThumbUrl = `https://img.youtube.com/vi/${vidID}/maxresdefault.jpg`;
        imgtag.src = ytThumbUrl;
      } else if (imgurl.indexOf("https://youtu.be/") != -1) {

        let vidID = imgurl.split("be/")[1].substring(0, 11);
        let ytThumbUrl = `https://img.youtube.com/vi/${vidID}/maxresdefault.jpg`;
        imgtag.src = ytThumbUrl;
      } else if (imgurl.match(/\.(gif|jpe?g|tiff?|png|webp|bmp)$/i)) {

        imgtag.src = imgurl;
      } else {

        imgtag.src = "";
        previewarea.classList.remove("active");
      }
      
      hiddenimp.value = imgtag.src;

      console.log(imgtag.src);
      console.log(hiddenimp.value)
    };
  </script>
</html>
