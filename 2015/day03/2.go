package main

import (
	"fmt"
	"os"
	"github.com/mirsch/advent-of-code/util"
)

func charXY(char string, x int, y int) (int, int) {
	switch char {
	case ">":
		x++
	case "<":
		x--
	case "^":
		y--
	case "v":
		y++
	}

	return x, y
}

func checkHouse(houses *map[int]map[int]int, x int, y int, uniqueHouses *int) {
	visitedCount, visited := (*houses)[x][y]
	fmt.Println(x, y, visited, visitedCount)
	if ! visited || visitedCount == 0 {
		_, xx := (*houses)[x]
		if ! xx {
			(*houses)[x] = map[int]int{0: 0}
		}
		(*houses)[x][y]++
		*uniqueHouses++
		return
	}

	(*houses)[x][y]++
}

func main() {
	lines := file.GetLinesFromFile(os.Args[1])
	houses := map[int]map[int]int{0: map[int]int {0: 1}}
	uniqueHouses := 1
	x, y, xr, yr := 0, 0, 0, 0
	for _, line := range lines {
		for i := 0; i < len(line); i+=2 {
			x, y = charXY(string(line[i]), x, y) 
			xr, yr = charXY(string(line[i+1]), xr, yr) 
			checkHouse(&houses, x, y, &uniqueHouses)			
			checkHouse(&houses, xr, yr, &uniqueHouses)			
		}
	}
	
	fmt.Printf("houses: %d\n", uniqueHouses)
}

