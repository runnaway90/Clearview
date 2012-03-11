import Data.List
import Control.Monad

text = "Proin vestibulum nisl sed urna semper sit amet hendrerit augue venenatis. Nam eu massa velit, volutpat sollicitudin sem. Duis eu lorem blandit quam mollis sollicitudin mollis at nisi. Mauris cursus auctor placerat. In et malesuada nisl. Praesent consequat luctus erat in adipiscing. Sed sagittis sollicitudin dui non lacinia. Vivamus eros purus, posuere eget consequat quis, facilisis ut lorem. In viverra, nunc hendrerit condimentum posuere, felis ipsum gravida erat, molestie ultrices lectus ante ac sem. Pellentesque in risus lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam ac sem ante. Mauris lorem massa, tempor ac semper in, convallis quis arcu. Etiam mauris massa, congue quis fringilla eget, sollicitudin vel purus. Nulla facilisi. Etiam vel ipsum urna. Suspendisse fermentum ornare tellus id vestibulum. Pellentesque in tortor tortor, vel volutpat lacus. Cras eleifend dignissim ultrices. Suspendisse ornare metus dictum augue elementum scelerisque. Duis convallis pretium scelerisque. Phasellus sit amet nulla risus, vitae ornare velit. Etiam ultrices malesuada congue. Integer dapibus dapibus adipiscing. Donec viverra fringilla lectus, eu cursus felis pretium eleifend. Integer dignissim tincidunt condimentum. Nam quis orci at leo euismod faucibus quis a justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quis mauris purus, ut fermentum turpis. Proin fermentum faucibus blandit. Sed vehicula euismod accumsan. In lobortis fringilla leo, ac blandit augue aliquet nec. Integer dictum, orci at tempus viverra, mi neque tempor urna, sed aliquam metus purus imperdiet nisl. Duis orci sem, adipiscing quis pharetra nec, feugiat non dui. Sed in quam a magna tincidunt."
main = writeFile "list of words.txt" (show ((filter (\x -> (length x) > 0) (split text))))

wordsWhen :: (Char -> Bool) -> String -> [String]
wordsWhen p s =  case dropWhile p s of
                      "" -> []
                      s' -> w : wordsWhen p s''
                            where (w, s'') = break p s'

split :: String -> [String]
split text = wordsWhen (==' ') (filter (`elem` lettersSpace) text)

lettersSpace = "abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ"