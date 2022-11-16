    <?php
    $n = $_GET["Jugador1"];
    $e = $_GET["Jugador2"];
    echo "<center>  ESTAMOS LISTOS JUGADORES !!COMENZAMOS!! </center>";
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JUEGO BATALLA NAVAL.php</title>
    </head>
    <body style="background-image: url('img/juego.jpg'); background-size:cover; background-repeat: no-repeat;">
        <center>
            <div> 
                <button id="btnInicio" style="height: 50px;width: 170px;font-family: 'Times New Roman';font-size: 20px;border-radius: 20px;background-color: cornflowerwhite; margin:50px; cursor:pointer; display:block;">Comenzar Juego</button>
            </div>
            <div>
                <br><br>
                <b><span id="txt" style="display:none; font-size:30px;">Elige un lugar para poder tirar</span></b>
                <br>
            </div>
            <div id="t1" style="display:none;">
            <h3>Ahora es turno del otro jugador <?php echo $n;?></h3>
            <br><br>
            <table>
                <?php
                //Aqui se crea el tablero para el primer jugador
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td id="<?php echo $i;?>-<?php echo $j;?>-j2" style="width: 30px; height: 30px; background-color: blue; border: solid 2px black; border-radius: 2px;" onclick="tirarj1('<?php echo $i;?>','<?php echo $j;?>')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
            </div>
            <div id="t2" style="display:none;">
            <h3>Ahora es turno del otro jugador <?php echo $e;?></h3>
            <table>
                <?php
                //Aqui se crea el tablero para el segundo jugador
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td id="<?php echo $i;?>-<?php echo $j;?>-j1" style="width: 30px; height: 30px; background-color: yellow; border: solid 2px black; border-radius: 2px;" onclick="tirarj2('<?php echo $i;?>','<?php echo $j;?>')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
            </div>
        </center>
        <script>
            //Declaracion de variables
            nj1="<?php echo $n;?>";
            nj2="<?php echo $e;?>";
            var b=document.getElementById("btnInicio");
            var t1=document.getElementById("t1");
            var t2=document.getElementById("t2");
            var txt=document.getElementById("txt");
            var tj1=[[],[],[],[],[],[],[],[],[],[]];
            var tj2=[[],[],[],[],[],[],[],[],[],[]];
            var bj1=0;
            var bj2=0;
            var bj1x=[];
            var bj1y=[];
            var bj2x=[];
            var bj2y=[];
            var turnoj1=true;
            var turnoj2=false;
            var ganar=false;
            
            //creacion de lo arrays y agregacion de los barcos por metodo random
            for(let i=0;i<10;i++){
                for(let j=0;j<10;j++){
                    tj1[i][j]=0;
                    tj2[i][j]=0;
                }
            }
            while(bj1<10){
                let x = Math.floor(Math.random()*(9-0)+0);
                let y = Math.floor(Math.random()*(9-0)+0);
                if(tj1[y][x]!=1){
                    bj1x[bj1]=x;
                    bj1y[bj1]=y;
                    tj1[y][x]=1
                    bj1++
                }
            }
            while(bj2<10){
                let x = Math.floor(Math.random()*(9-0)+0);
                let y = Math.floor(Math.random()*(9-0)+0);
                if(tj2[y][x]!=1){
                    bj2x[bj2]=x;
                    bj2y[bj2]=y;
                    tj2[y][x]=1
                    bj2++
                }
            }

            //funcion para iniciar el juego
            b.addEventListener('click', function(){
                b.style.display="none";
                t1.style.display="block";
                txt.style.display="block";
            })

            //funcion del tiro del primer jugador
            function tirarj1(y,x){
                if(ganar!=true){
                    //1 significa que hay un barco, 2 que ya ha tirado ahí y 0 un espacio de mar
                    //comparaciones para verificar el tiro
                    if(tj2[y][x]==1){
                        txt.textContent=nj1+" Felicidades le has dado a un barco, vuelve a tirar.";
                        document.getElementById(y+"-"+x+"-j2").style.backgroundColor="pink";
                        tj2[y][x]=2;
                        turnoj1=true;
                        bj2--;

                        //se comprueba si el primer ha tirado todos los barcos
                        if(bj2==0){
                            alert(nj1+" WaaOoOoO has ganado ");
                            txt.textContent=nj1+" WaaOoOoO has ganado ";
                            ganar=true;
                        }
                    }else if(tj2[y][x]==2){
                        txt.textContent="JAJAJA, ya tiraste aqui";
                        turnoj1=true;
                    }else if(tj2[y][x]==0){
                        document.getElementById(y+"-"+x+"-j2").style.backgroundColor="black";
                        tj2[y][x]=2;
                        txt.textContent=nj1+" Ni modo, le toca al otro jugador "+nj2;
                        turnoj1=false
                    }
                    if(turnoj1==false){
                        t1.style.display="none";
                        t2.style.display="block";
                    }
                }
            }

            //funcion del tiro del jugador 2
            function tirarj2(y,x){
                if(ganar!=true){
                    //1 significa que hay un barco, 2 que ya ha tirado ahí y 0 un espacio de mar
                    //comparaciones para verificar el tiro
                    if(tj1[y][x]==1){
                        txt.textContent=nj2+" Felicidades le has dado a un barco, vuelve a tirar.";
                        document.getElementById(y+"-"+x+"-j1").style.backgroundColor="Orange";
                        tj1[y][x]=2;
                        turnoj2=true;
                        bj1--;

                        //comparar si el jugador 2 ha tirado todos los barcos
                        if(bj1==0){
                            alert(nj2+" Bravooooo, eres el winner");
                            txt.textContent=nj2+" Bravo, eres el winer";
                            ganar=true;
                        }
                    }else if(tj1[y][x]==2){
                        txt.textContent="JAJAJA, ya tiraste aqui";
                        turnoj2=true;
                    }else if(tj1[y][x]==0){
                        document.getElementById(y+"-"+x+"-j1").style.backgroundColor="black";
                        tj1[y][x]=2;
                        txt.textContent=nj2+" Ni modo, le toca al otro jugador "+nj1;
                        turnoj2=false;
                    }
                    if(turnoj2==false){
                        t1.style.display="block";
                        t2.style.display="none";
                    }
                }
            }
        </script>
    </body>
    </html>