type Graph = [(Integer, [Integer])]

getVertices :: Graph -> [Integer]
getVertices [] = []
getVertices (v:vs) = [fst v] ++ getVertices vs

getListOfEdges :: Graph -> [[Integer]]
getListOfEdges [] = []
getListOfEdges (g:gs) = [snd g] ++ getListOfEdges gs

getAdjacentVertices :: Int -> Graph -> [Integer]
getAdjacentVertices n g = getListOfEdges g !! n

ampleSwarms g = calcSwarm [] [] getVertices g [] g

calcSwarm r x all@(p:ps) s g
    | null[all] == True && null[x] == True = s ++ r
    | otherwise = calcSwarm r ++ p _ ps s g

