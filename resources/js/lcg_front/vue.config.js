let publicPath = process.env.NODE_ENV === 'production' ? 'lcg-front/' : '/';

module.exports = {
  publicPath,
  productionSourceMap: false,
};
