/**
 * @function
 * @memberof Modifiers
 * @argument {Object} data - The data object generated by update method
 * @argument {Object} options - Modifiers configuration and options
 * @returns {Object} The data object, properly modified
 */
export default function keepTogether(data)
{
    const { popper, reference } = data.offsets;
    const placement = data.placement.split('-')[0];
    const floor = Math.floor;
    const isVertical = ['top', 'bottom'].indexOf(placement) !== -1;
    const side = isVertical ? 'right' : 'bottom';
    const opSide = isVertical ? 'left' : 'top';
    const measurement = isVertical ? 'width' : 'height';

    if (popper[side] < floor(reference[opSide])) {
        data.offsets.popper[opSide] =
        floor(reference[opSide]) - popper[measurement];
    }
    if (popper[opSide] > floor(reference[side])) {
        data.offsets.popper[opSide] = floor(reference[side]);
    }

    return data;
}
