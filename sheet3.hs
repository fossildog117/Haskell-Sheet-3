trueList :: Int -> [Bool] -> IO ()
trueList n a = if a == take n (repeat True)
               then print "True"
               else print "False"

evenList :: Integral a => [a] -> IO ()
evenList x = if sum(map(`rem` 2) x ) == 0 
             then print "All elements are even"
             else print "There are one or more elements that are not even"
        
inRange :: (Enum a, Num a) => [a]
inRange x y = drop (x - 1) [1..y]

countPositive :: (Num a, Num a1, Ord a1) => a1 -> a
countPositive x = sum([if x < 0 then 0 else 1 | x <- x ])

newLength :: Num b => b
newLength x = foldl (+) 0(map (+1) (map (0*) [2,1,1]))