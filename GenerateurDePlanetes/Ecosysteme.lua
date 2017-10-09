Ecosysteme = {}
Ecosysteme.__index = Ecosysteme

function Ecosysteme.new(biome)

	local ecosysteme = {}

	setmetatable(ecosysteme, Ecosysteme)

	Ecosysteme.sousol = {}

	Ecosysteme[0] = 3

	return ecosysteme

end
