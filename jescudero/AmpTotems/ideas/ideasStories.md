## YTB list
https://www.youtube.com/shorts/N21LHrgVgHY
https://www.youtube.com/shorts/2GYCjgMBF6A
https://www.youtube.com/shorts/Lg6bacAeQKY?feature=share



https://www.youtube.com/shorts/lYkJzfeTbWs?feature=share (Arduino in 60 seconds)
https://www.youtube.com/shorts/Bfg58rrL5ws?feature=share (BreadBoard 60 seconds)



Stories
- TIL - Today I learned
- ICF - Inclusion Cultural Forzada
- Países del mundo
- Constelaciones del cielo
- Como sujetar a un cocodrilo - http://pekevasion.blogspot.com/2021/07/como-sujetar-un-cocodrilo.html
- Enciclopedia de los jóvenes castores
- Enciclopedia of Life (convert QR_02.png -gravity South -pointsize 30 -fill yellow -annotate +0+20 'SUGERENCIA' QR_03.png)
- Estados de EEUU 
- Provincias de China
- https://www.timesnownews.com/web-stories/technology/10-hidden-websites-on-the-internet-that-give-you-superpowers/photostory/105006054.cms
- FRASES

API
- Efemérides - https://www.frasesyefemerides.com/efemerides-por-mes-y-dia.php



Anexos
- QR codes - https://www.howtogeek.com/devops/how-to-create-qr-codes-from-the-linux-command-line/ - qrencode


``` bash
sudo apt install qrencode
sudo apt install imagemagick

qrencode -s6 -l H -o "QR_00.png" "https://www.youtube.com/watch?v=wVn491dV4lU"

convert QR_00.png -background black -gravity south -splice 0x60 QR_01.png

convert QR_01.png -bordercolor black -border 10 \
  -background none -alpha background \
  \( +clone -alpha extract \
  -draw 'fill black polygon 0,0 0,15 15,0 fill white circle 15,15 15,0' \
  \( +clone -flip \) -compose Multiply -composite \
  \( +clone -flop \) -compose Multiply -composite \) \
  -alpha off -compose CopyOpacity -composite QR_02.png

convert QR_02.png -gravity South -pointsize 30 -fill yellow -annotate +0+20 'MÍRAME' MIRAME_Medusa.png

qrencode -s6 -l H -o "QR_00.png" "https://fama.us.es/permalink/34CBUA_US/3enc2g/alma991012110989704987"

convert QR_00.png -background black -gravity south -splice 0x60 QR_01.png

convert QR_01.png -bordercolor black -border 10 \
  -background none -alpha background \
  \( +clone -alpha extract \
  -draw 'fill black polygon 0,0 0,15 15,0 fill white circle 15,15 15,0' \
  \( +clone -flip \) -compose Multiply -composite \
  \( +clone -flop \) -compose Multiply -composite \) \
  -alpha off -compose CopyOpacity -composite QR_02.png

convert QR_02.png -gravity South -pointsize 30 -fill yellow -annotate +0+20 'LEEME' LEEME_Medusa.png


```



https://www.youtube.com/shorts/r9XcPB2Utxs?feature=share



https://www.youtube.com/watch?v=Vzx3vuxh04Q&ab_channel=MarcusCarter (Profe de ingles)

``` bash
qrencode -s6 -l H -o "QR_00.png" "https://www.youtube.com/watch?v=kbxZJ8MK5Vw"

convert QR_00.png -background black -gravity south -splice 0x60 QR_01.png

convert QR_01.png -bordercolor black -border 10 \
  -background none -alpha background \
  \( +clone -alpha extract \
  -draw 'fill black polygon 0,0 0,15 15,0 fill white circle 15,15 15,0' \
  \( +clone -flip \) -compose Multiply -composite \
  \( +clone -flop \) -compose Multiply -composite \) \
  -alpha off -compose CopyOpacity -composite QR_02.png

convert QR_02.png -gravity South -pointsize 30 -fill yellow -annotate +0+20 'MÍRAME' MIRAME_Nauru.png

qrencode -s6 -l H -o "QR_00.png" "https://fama.us.es/permalink/34CBUA_US/3enc2g/alma991013379944204987"

convert QR_00.png -background black -gravity south -splice 0x60 QR_01.png

convert QR_01.png -bordercolor black -border 10 \
  -background none -alpha background \
  \( +clone -alpha extract \
  -draw 'fill black polygon 0,0 0,15 15,0 fill white circle 15,15 15,0' \
  \( +clone -flip \) -compose Multiply -composite \
  \( +clone -flop \) -compose Multiply -composite \) \
  -alpha off -compose CopyOpacity -composite QR_02.png

convert QR_02.png -gravity South -pointsize 30 -fill yellow -annotate +0+20 'LEEME' LEEME_Nauru.png

```


https://convert.leiapix.com (Animación de imágenes)
https://playground.com/



