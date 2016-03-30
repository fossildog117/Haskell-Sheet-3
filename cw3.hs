type Graph = [(Integer, [Integer])]

-- Gets vertices 1 to x of a given graph
getVertices :: Graph -> [Integer]
getVertices [] = []
getVertices (v:vs) = [fst v] ++ getVertices vs

-- Gets list of edges
getListOfEdges :: Graph -> [[Integer]]
getListOfEdges [] = []
getListOfEdges (g:gs) = [snd g] ++ getListOfEdges gs

-- Gets a list of edges connected to a vertex n 
getAdjacentVertices :: Int -> Graph -> [Integer]
getAdjacentVertices n g = getListOfEdges g !! n

ampleSwarms g = calcSwarm [] [] getVertices g [] g

calcSwarm r x all@(p:ps) s g
    | null[all] == True && null[x] == True = s ++ r
    | otherwise = calcSwarm r ++ p _ ps s g

