<html>
    <head>
        <style type="text/css">
            .coupon {
                border: 2px solid #bbb; 
                width: 80%; 
                border-radius: 0px; 
                margin: 0 auto; 
                max-width: 600px;
            }
            
            .container {
                padding: 2px 16px;
                background-color: #f1f1f1;
            }
            
            .text-right {
                text-align: right;
            }

            h1 {
                margin-bottom: 50px;
            }

            p {
                font-size: 18px;
            }
        </style>
    </head>
    
    <body>

        <div class="coupon">
          <div class="container" style="background-color:white">
            <p>
                From: <a href="mailto:speed-dating@pampuni.com">speed-dating@pampuni.com</a>
            </p>
            <p>
                To: <a href="mailto:{{$couple_email}}">{{$couple_email}}</a>
            </p>
            <div class="text-right">
                <h1>יש לכם מאצ'</h1>
                <h2>נראה שהלך לכם לא רע!</h2>
                <p> {{$female->first_name}} - {{$female->phone}} </p>
                <p> {{$male->first_name}} - {{$male->phone}} </p>
                <p>תמשיכו מכאן ;</p>
                <p>רוצים לדעת על האירוע הבא? תנו לייק כאן ה</p>
                <p>
                    <a href="https://www.facebook.com/speeddateisrael">https://www.facebook.com/speeddateisrael</a>
                </p>
            </div>
          </div>
        </div>
    </body>
</html>