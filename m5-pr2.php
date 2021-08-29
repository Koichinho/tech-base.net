 <?php
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "CREATE TABLE IF NOT EXISTS tbm5"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "datetime TEXT,"
    . "password TEXT"
    .");";
    $stmt = $pdo->query($sql);
        
        $comment = $_POST["comment"];//コメント
        $name = $_POST["name"];//名前
        $number1 = $_POST["number1"];//消去番号
        $number2 = $_POST["number2"];//編集番号
        $number3 = $_POST["number3"];//新しく書くか編集なのかを見分ける番号
        $datetime =date("Y/m/d H:i:s");//日時
        $value1="";
        $value2="";
        $password1 = $_POST["password"];//自分で決めるパスワード
        $password2 = $_POST["password2"];//消去するときに必要なパスワード
        $password3 = $_POST["password3"];//編集するときに必要なパスワード
        
        if(!empty($number3)){//編集番号がありパスワードが合ってるとき入力フォームに名前とコメントを出力
            
            $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row["id"]==$number3&&$row["password"]==$password3){
            $value1=$row["name"];
            $value2=$row["comment"];
            
        }
            
        }
        
            
        }
        
?>
<!DOCTYPE html>
<html lang="ja">
   <head>
   <meta charset ="uft-8">
   <title>m5-1.php</title>
   </head>
   <body>
       この掲示板のテーマ
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value="<?php echo $value1;?>"><br>
        <input type="text" name="comment" placeholder="コメント" value="<?php echo $value2;?>"><br>
        <input type="text" name="password" placeholder="パスワードを設定">
        <input type="hidden" name="number1" value="<?php if(!empty($number3)){$sql = 'SELECT * FROM tbm5';$stmt = $pdo->query($sql);$results = $stmt->fetchAll();foreach ($results as $row){if($row["id"]==$number3&&$row["password"]==$password3){echo $number3;}else if($row["id"]==$number3&&$row["password"]!=$password3){echo "";}}}?>">
        <input type="submit" name="submit"><br><br>
        
        <input type="number" name="number2" placeholder="削除対象番号" ><br>
        <input type="text" name="password2" placeholder="パスワード">
        <input type="submit" value="消去"><br><br>
        
        <input type="number" name="number3" placeholder="編集対象番号" ><br>
        <input type="text" name="password3" placeholder="パスワード">
        <input type="submit" value="編集">
        </form>
    <?php
        
    if(empty($number1)&&empty($number2)&&empty($number3)&&empty($comment)&&empty($name)&&empty($password1)){
            //名前とコメントなし
        echo "名前とコメントを入力してください。<br>";
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }
        
    }
        
        else if(empty($number1)&&empty($number2)&&empty($number3)&&empty($comment)&&!empty($name)&&empty($password1)){
            //コメントなし
        echo "コメントを入力してください。<br>";
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }
        }
        
        else if(empty($number1)&&empty($number2)&&empty($number3)&&!empty($comment)&&empty($name)&&empty($password1)){
            //名前なし
        echo "名前を入力してください。<br>";
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }}
        
        
        else if(empty($number1)&&empty($number2)&&empty($number3)&&!empty($comment)&&!empty($name)&&empty($password1)){
            //パスワードなし
        echo "パスワードを入力してください。<br>";
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }
        }
        
        else if(empty($number1)&&empty($number2)&&empty($number3)&&!empty($comment)&&!empty($name)&&!empty($password1)){
        $sql = $pdo -> prepare("INSERT INTO tbm5 (name, comment, datetime, password) VALUES (:name, :comment, :datetime, :password)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password1, PDO::PARAM_STR);
        $sql -> execute();
          
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }
                
            }
        
        if(empty($number1)&&!empty($number2)&&empty($number3)&&empty($comment)&&empty($name)){//消去
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row["id"]==$number2&&$row["password"]==$password2){
            //パスワードが合ってるとき
            $id = $number2;
            $sql = 'delete from tbm5 where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $sql = 'SELECT * FROM tbm5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'];
                echo $row['name'];
                echo $row['comment'];
                echo $row['datetime'].'<br>';
                echo "<hr>";
                
            }    
            }
        else if($row["id"]==$number2&&$row["password"]!=$password2){
            //パスワードが間違ってるとき
            echo "パスワードが間違っています。<br>";
            $sql = 'SELECT * FROM tbm5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'];
                echo $row['name'];
                echo $row['comment'];
                echo $row['datetime'].'<br>';
                echo "<hr>";
                    
                
            }
                
            
        }
            
        }
            
        }
        
        else if(empty($number1)&&empty($number2)&&!empty($number3)&&empty($comment)&&empty($name)){//編集番号入力
        $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row["id"]==$number3&&$row["password"]==$password3){
            //パスワードが合ってるとき
                $sql = 'SELECT * FROM tbm5';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                    //$rowの中にはテーブルのカラム名が入る
                    echo $row['id'];
                    echo $row['name'];
                    echo $row['comment'];
                    echo $row['datetime'].'<br>';
                    echo "<hr>";
                    
                }
                
            }
            else if($row["id"]==$number3&&$row["password"]!=$password3){
                //パスワードが間違ってるとき
                echo "パスワードが間違っています。<br>";
                $sql = 'SELECT * FROM tbm5';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                    //$rowの中にはテーブルのカラム名が入る
                    echo $row['id'];
                    echo $row['name'];
                    echo $row['comment'];
                    echo $row['datetime'].'<br>';
                    echo "<hr>";
                    
                }   
            
                
            }
            
        }
                
            }
            
        
        
        else if(!empty($number1)&&empty($number2)&&empty($number3)&&empty($comment)&&empty($name)&&empty($password1)){//何も入力してないとき
            echo "編集失敗文字を入力してください。<br>";
         $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'];
            echo $row['name'];
            echo $row['comment'];
            echo $row['datetime'].'<br>';
            echo "<hr>";
            
        }
        }
        
        
        else if(!empty($number1)&&empty($number2)&&empty($number3)&&!empty($comment)&&!empty($name)){
             $sql = 'SELECT * FROM tbm5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row["id"]==$number1&&$row["password"]==$password1){
            //パスワードが合ってるとき
            $id = $number1; //変更する投稿番号
            $name1 = $name;
            $comment1 = $name;
            $sql = 'UPDATE tbm5 SET name=:name,comment=:comment,datetime=:datetime WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(":datetime",$datetime, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $sql = 'SELECT * FROM tbm5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'];
                echo $row['name'];
                echo $row['comment'];
                echo $row['datetime'].'<br>';
                echo "<hr>";
                
            }    
            }
        else if($row["id"]==$number1&&$row["password"]!=$password1){
            //パスワードが間違ってるとき
            echo "パスワードが間違っています。<br>";
            $sql = 'SELECT * FROM tbm5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'];
                echo $row['name'];
                echo $row['comment'];
                echo $row['datetime'].'<br>';
                echo "<hr>";
                    
                
            }
                
            
        }
            
        }
        }
        
        ?>
   </body>
   </html>