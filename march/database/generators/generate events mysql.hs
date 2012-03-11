import Control.Monad
import System.Random

filename = "add events.php"

gen :: Int -> IO ()
gen x = do
    gen <- newStdGen
    let ns = randoms gen :: [Int]
    writeFile filename (beginFile ++ (gem x ns 1) ++ endFile)

beginFile = "<?php\n"
    ++ "include '../../login/db_config.php';\n"
    ++ "$conn = mysql_connect($dbhost, $dbuser, $dbpass);\n"
	++ "mysql_select_db($dbname, $conn);\n"
    ++ "$query = \"INSERT INTO `events`\n"
    ++ "(`event_id`, `title`, `privacy_level`, `price`, `body`, `short_description`, `long_description`, `society_id`, `online_booking`, `available_places`, `start_time`, `end_time`, `place`)\n"
    ++ "VALUES\n"
endFile = "\";\n$result = mysql_query($query);\n"
    ++ "?>"

gem :: Int -> [Int] -> Int -> String
gem x ns y | x > 1     = ((values ns y) ++ ",\n") ++ (gem (x-1) ns (y+20))
           | otherwise = (values ns y) ++ ";"

rndNum :: [Int] -> Int -> Int
rndNum ns y = (ns !! y) `mod` limit

rndPairWord :: [Int] -> Int -> String
rndPairWord ns y = (ipsums !! rndNum ns y) ++ " " ++ (ipsums !! rndNum ns (y+1))

ipsums = ["Proin","vestibulum","nisl","sed","urna","semper","sit","amet","hendrerit","augue","venenatis","Nam","eu","massa","velit","volutpat","sollicitudin","sem","Duis","eu","lorem","blandit","quam","mollis","sollicitudin","mollis","at","nisi","Mauris","cursus","auctor","placerat","In","et","malesuada","nisl","Praesent","consequat","luctus","erat","in","adipiscing","Sed","sagittis","sollicitudin","dui","non","lacinia","Vivamus","eros","purus","posuere","eget","consequat","quis","facilisis","ut","lorem","In","viverra","nunc","hendrerit","condimentum","posuere","felis","ipsum","gravida","erat","molestie","ultrices","lectus","ante","ac","sem","Pellentesque","in","risus","lacus","Cum","sociis","natoque","penatibus","et","magnis","dis","parturient","montes","nascetur","ridiculus","mus","Nam","ac","sem","ante","Mauris","lorem","massa","tempor","ac","semper","in","convallis","quis","arcu","Etiam","mauris","massa","congue","quis","fringilla","eget","sollicitudin","vel","purus","Nulla","facilisi","Etiam","vel","ipsum","urna","Suspendisse","fermentum","ornare","tellus","id","vestibulum","Pellentesque","in","tortor","tortor","vel","volutpat","lacus","Cras","eleifend","dignissim","ultrices","Suspendisse","ornare","metus","dictum","augue","elementum","scelerisque","Duis","convallis","pretium","scelerisque","Phasellus","sit","amet","nulla","risus","vitae","ornare","velit","Etiam","ultrices","malesuada","congue","Integer","dapibus","dapibus","adipiscing","Donec","viverra","fringilla","lectus","eu","cursus","felis","pretium","eleifend","Integer","dignissim","tincidunt","condimentum","Nam","quis","orci","at","leo","euismod","faucibus","quis","a","justo","Vestibulum","ante","ipsum","primis","in","faucibus","orci","luctus","et","ultrices","posuere","cubilia","Curae","Suspendisse","quis","mauris","purus","ut","fermentum","turpis","Proin","fermentum","faucibus","blandit","Sed","vehicula","euismod","accumsan","In","lobortis","fringilla","leo","ac","blandit","augue","aliquet","nec","Integer","dictum","orci","at","tempus","viverra","mi","neque","tempor","urna","sed","aliquam","metus","purus","imperdiet","nisl","Duis","orci","sem","adipiscing","quis","pharetra","nec","feugiat","non","dui","Sed","in","quam","a","magna","tincidunt"]
limit = length ipsums

values :: [Int] -> Int -> String
values ns y = "( \'" 
    ++ (show $ rndNum ns y) -- event_id
    ++ "\', \'" 
    ++ (rndPairWord ns (y+1)) -- title
    ++ "\', \'" 
    ++ (show $ (rndNum ns (y+3)) `mod` 3) -- privacy_level
    ++ "\', \'" 
    ++ (show $ rndNum ns (y+4)) -- price
    ++ "\', \'" 
    ++ (rndPairWord ns (y+5)) ++ " " -- body
    ++ (rndPairWord ns (y+7)) ++ " " -- body
    ++ (rndPairWord ns (y+9)) ++ " " -- body
    ++ (rndPairWord ns (y+11))       -- body
    ++ "\', \'" 
    ++ (rndPairWord ns (y+5)) ++ " " -- short_description
    ++ (rndPairWord ns (y+7))        -- short_description
    ++ "\', \'" 
    ++ (rndPairWord ns (y+5)) ++ " " -- long_description
    ++ (rndPairWord ns (y+7)) ++ " " -- long_description
    ++ (rndPairWord ns (y+9))        -- long_description
    ++ "\', \'" 
    ++ (show $ rndNum ns (y+13)) -- society_id
    ++ "\', \'" 
    ++ (show $ (rndNum ns (y+14)) `mod` 2) -- online_booking
    ++ "\', \'" 
    ++ (show $ rndNum ns (y+15)) -- available_places
    ++ "\', \'" 
    ++ "0000-00-00 00:00:00" -- start_time
    ++ "\', \'" 
    ++ "0000-00-00 00:00:00" -- end_time
    ++ "\', \'" 
    ++ (rndPairWord ns (y+17)) -- place
    ++ "\' )"

