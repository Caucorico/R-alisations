function clamp(n,low,high)
	return math.min(math.max(low, n), high)
end

function side(n,low,high)

	if n > high then

		return low

	elseif n < low then

		return high

	else

		return n

	end

end

function top(y,x,low,high)

	if y > high then

		if x < 100 then

			return 100 + x

		else

			return 200 - x

		end

	elseif y < low then

		if x < 100 then

			return 100 + x

		else

			return 200 - x

		end

	else

		return x

	end

end
