let publicPath = process.env.NODE_ENV === 'production' ? 'lcg-admin/' : '/';

module.exports = {
  publicPath,
  productionSourceMap: false,
};
