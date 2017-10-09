Planete = {}
Planete.__index = Planete

function Planete.new()

	local planete = {}

	setmetatable(planete, Planete)

	planete.ocean = setOcean()

	setOcean()

	planete.regions = {}

	for i=1,200 do

		planete.regions[i] = {}

		for j=1,200 do

			planete.regions[i][j] = Region.new(i,j,planete.ocean)

		end

	end

	return planete

end

function Planete:setAltitude()

	local var = love.math.random(-1,1)

	local var2 = love.math.random(-1,1)

	local x = love.math.random(1,200) 

	local y = love.math.random(1,200)

	local cpt = 0

	for k=1,250 do

		for j=1,10 do

			while self.regions[x][y]:obtenirAltitude() < cpt do

				x = love.math.random(1,200)

				y = love.math.random(1,200)

			end

			for i=1,100 do

				self.regions[x][y]:varierAltitude(1)

				x  = x + var2

				y = y + var

				x = top( y , side(x,1,200) , 1 , 200)

				x = side( x , 1 , 200 )

				y = clamp( y , 1 , 200 )

				var = love.math.random(-1,1)

				var2 = love.math.random(-1,1)

			end

			cpt = cpt + 1

			x = love.math.random(1,200)

			y = love.math.random(1,200)

		end

		cpt = 0

	end

end

function Planete:setErosion()

	local var = love.math.random(-1,1)

	local var2 = love.math.random(-1,1)

	local x = love.math.random(1,200)

	local y = love.math.random(1,200)

	--local cpt = 0

	for k=1,10 do 

		for j=1,10 do

		--	while self.regions[x][y]:obtenirAltitude() < cpt do

			--	x = love.math.random(1,200)

			--	y = love.math.random(1,200)

		--	end

			for i=1,2500 do

				self.regions[x][y]:varierAltitude(-1)

				x  = x + var2

				y = y + var

				x = top( y , side(x,1,200) , 1 , 200) 

				x = side( x , 1 , 200 )

				y = clamp( y , 1 , 200 )

				var = love.math.random(-1,1)

				var2 = love.math.random(-1,1)

			end

			--cpt = cpt + 1

			x = love.math.random(1,200)

			y = love.math.random(1,200)

		end

		cpt = 0

	end

end

function Planete:setPrecipitation()

	local var = love.math.random(-1,1)

	local var2 = love.math.random(-1,1)

	local x = love.math.random(1,200)

	local y = love.math.random(1,200)

	local cpt = 0

	for k=1,1000 do


		for j=1,100 do

			while self.regions[x][y]:obtenirPrecipitation() < cpt do

				x = love.math.random(1,200)

				y = love.math.random(1,200)

			end

			for i=1,100 do

				self.regions[x][y]:varierPrecipitation(1)

				x  = x + var2

				y = y + var

				--x = top( y , side(x,1,200) , 1 , 200) --marche pas :(

				x = side( x , 1 , 200 )

				y = clamp( y , 1 , 200 )

				var = love.math.random(-1,1)

				var2 = love.math.random(-1,1)

			end

			cpt = cpt + 1

			x = love.math.random(1,200)

			y = love.math.random(1,200)

		end

		cpt = 0

	end

end

function Planete:setBiome()

	for i=1,200 do

		for j=1,200 do

			self.regions[i][j]:setBiome()

			self.regions[i][j]:setCouleur()

		end

	end

end


function setOcean()

	return love.math.random(0,25)

end


function Planete:draw()

	for i=1,200 do

		for j=1,200 do

			love.graphics.setColor(self.regions[i][j]:obtenirRouge(), self.regions[i][j]:obtenirVert(), self.regions[i][j]:obtenirBleu() )

			love.graphics.rectangle("fill", i*5, j*5, 5, 5)

		end

	end

end
