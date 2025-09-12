import React, { useState, useEffect } from 'react';
import { CreditCard, Calendar, Download, Eye, AlertTriangle, Filter, Search, CheckCircle, Clock, XCircle } from 'lucide-react';
import { paymentsApi } from '../services/api';
import type { Payment } from '../types';
import { cn } from '../utils/cn';

const PaymentsPage: React.FC = () => {
  const [payments, setPayments] = useState<Payment[]>([]);
  const [filteredPayments, setFilteredPayments] = useState<Payment[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string>('');
  const [searchTerm, setSearchTerm] = useState('');
  const [statusFilter, setStatusFilter] = useState<string>('all');
  const [selectedPayment, setSelectedPayment] = useState<Payment | null>(null);
  const [showPaymentModal, setShowPaymentModal] = useState(false);

  useEffect(() => {
    fetchPayments();
  }, []);

  useEffect(() => {
    filterPayments();
  }, [payments, searchTerm, statusFilter]);

  const fetchPayments = async () => {
    try {
      setIsLoading(true);
      const response = await paymentsApi.getPayments();
      
      if (response.data.success) {
        setPayments(response.data.data);
      } else {
        setError('Failed to load payments data');
      }
    } catch (error: any) {
      setError('Failed to load payments data');
      console.error('Payments error:', error);
    } finally {
      setIsLoading(false);
    }
  };

  const filterPayments = () => {
    let filtered = payments;

    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(payment => 
        payment.description.toLowerCase().includes(searchTerm.toLowerCase()) ||
        payment.student_name?.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    // Filter by status
    if (statusFilter !== 'all') {
      filtered = filtered.filter(payment => payment.status === statusFilter);
    }

    setFilteredPayments(filtered);
  };

  const formatCurrency = (amount: number): string => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0,
    }).format(amount);
  };

  const formatDate = (dateString: string): string => {
    return new Date(dateString).toLocaleDateString('id-ID', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });
  };

  const getPaymentStatusBadge = (status: string) => {
    const statusConfig = {
      paid: { 
        color: 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400', 
        label: 'Paid',
        icon: CheckCircle
      },
      pending: { 
        color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400', 
        label: 'Pending',
        icon: Clock
      },
      overdue: { 
        color: 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400', 
        label: 'Overdue',
        icon: XCircle
      },
    };

    const config = statusConfig[status as keyof typeof statusConfig] || statusConfig.pending;
    const Icon = config.icon;
    
    return (
      <span className={cn('inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', config.color)}>
        <Icon className="h-3 w-3 mr-1" />
        {config.label}
      </span>
    );
  };

  const getStatusStats = () => {
    const stats = {
      total: payments.length,
      paid: payments.filter(p => p.status === 'paid').length,
      pending: payments.filter(p => p.status === 'pending').length,
      overdue: payments.filter(p => p.status === 'overdue').length,
      totalAmount: payments.reduce((sum, p) => sum + p.amount, 0),
      paidAmount: payments.filter(p => p.status === 'paid').reduce((sum, p) => sum + p.amount, 0),
      pendingAmount: payments.filter(p => p.status === 'pending').reduce((sum, p) => sum + p.amount, 0),
      overdueAmount: payments.filter(p => p.status === 'overdue').reduce((sum, p) => sum + p.amount, 0),
    };
    return stats;
  };

  const handlePaymentClick = (payment: Payment) => {
    setSelectedPayment(payment);
    setShowPaymentModal(true);
  };

  const handlePayNow = async (paymentId: number) => {
    try {
      // In a real app, this would integrate with a payment gateway
      const response = await paymentsApi.processPayment(paymentId);
      
      if (response.data.success) {
        // Refresh payments after successful payment
        fetchPayments();
        setShowPaymentModal(false);
        // Show success message
        alert('Payment processed successfully!');
      } else {
        alert('Payment failed. Please try again.');
      }
    } catch (error: any) {
      alert('Payment failed. Please try again.');
      console.error('Payment error:', error);
    }
  };

  const stats = getStatusStats();

  if (isLoading) {
    return (
      <div className="space-y-6">
        <div className="animate-pulse">
          <div className="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/4 mb-6"></div>
          <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {[...Array(4)].map((_, i) => (
              <div key={i} className="card p-6">
                <div className="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-2"></div>
                <div className="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/2 mb-4"></div>
                <div className="h-3 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
              </div>
            ))}
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="flex items-center justify-center min-h-[400px]">
        <div className="text-center">
          <AlertTriangle className="h-12 w-12 text-red-500 mx-auto mb-4" />
          <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">Failed to Load Payments</h3>
          <p className="text-gray-600 dark:text-gray-400 mb-4">{error}</p>
          <button
            onClick={fetchPayments}
            className="btn btn-primary"
          >
            Try Again
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
          Payments & Billing
        </h1>
        <p className="text-gray-600 dark:text-gray-400">
          Manage your payment history and outstanding bills.
        </p>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <CreditCard className="h-8 w-8 text-blue-600 dark:text-blue-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Payments
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.total}
              </p>
              <p className="text-xs text-gray-500 dark:text-gray-400">
                {formatCurrency(stats.totalAmount)}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <CheckCircle className="h-8 w-8 text-green-600 dark:text-green-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Paid
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.paid}
              </p>
              <p className="text-xs text-gray-500 dark:text-gray-400">
                {formatCurrency(stats.paidAmount)}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <Clock className="h-8 w-8 text-yellow-600 dark:text-yellow-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Pending
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.pending}
              </p>
              <p className="text-xs text-gray-500 dark:text-gray-400">
                {formatCurrency(stats.pendingAmount)}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <XCircle className="h-8 w-8 text-red-600 dark:text-red-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Overdue
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.overdue}
              </p>
              <p className="text-xs text-gray-500 dark:text-gray-400">
                {formatCurrency(stats.overdueAmount)}
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Filters and Search */}
      <div className="card p-6">
        <div className="flex flex-col sm:flex-row gap-4">
          <div className="flex-1">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
              <input
                type="text"
                placeholder="Search payments..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="input pl-10"
              />
            </div>
          </div>
          <div className="flex gap-2">
            <select
              value={statusFilter}
              onChange={(e) => setStatusFilter(e.target.value)}
              className="input"
            >
              <option value="all">All Status</option>
              <option value="paid">Paid</option>
              <option value="pending">Pending</option>
              <option value="overdue">Overdue</option>
            </select>
            <button className="btn btn-secondary">
              <Download className="h-4 w-4 mr-2" />
              Export
            </button>
          </div>
        </div>
      </div>

      {/* Payments List */}
      <div className="card p-6">
        <div className="space-y-4">
          {filteredPayments.length === 0 ? (
            <div className="text-center py-8">
              <CreditCard className="h-12 w-12 text-gray-400 mx-auto mb-4" />
              <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">No Payments Found</h3>
              <p className="text-gray-600 dark:text-gray-400">
                {searchTerm || statusFilter !== 'all' 
                  ? 'Try adjusting your search or filter criteria.'
                  : 'No payment records available.'}
              </p>
            </div>
          ) : (
            filteredPayments.map((payment) => (
              <div key={payment.id} className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <div className="flex items-center space-x-4">
                  <div className="flex-shrink-0">
                    <CreditCard className="h-6 w-6 text-gray-400" />
                  </div>
                  <div className="flex-1">
                    <div className="flex items-center space-x-2">
                      <h4 className="text-sm font-medium text-gray-900 dark:text-white">
                        {payment.description}
                      </h4>
                      {getPaymentStatusBadge(payment.status)}
                    </div>
                    <div className="flex items-center space-x-4 mt-1">
                      {payment.student_name && (
                        <p className="text-xs text-gray-500 dark:text-gray-400">
                          Student: {payment.student_name}
                        </p>
                      )}
                      <p className="text-xs text-gray-500 dark:text-gray-400">
                        Due: {formatDate(payment.due_date)}
                      </p>
                      {payment.paid_at && (
                        <p className="text-xs text-gray-500 dark:text-gray-400">
                          Paid: {formatDate(payment.paid_at)}
                        </p>
                      )}
                    </div>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="text-right">
                    <p className="text-lg font-bold text-gray-900 dark:text-white">
                      {formatCurrency(payment.amount)}
                    </p>
                  </div>
                  <div className="flex items-center space-x-2">
                    <button
                      onClick={() => handlePaymentClick(payment)}
                      className="btn btn-secondary btn-sm"
                    >
                      <Eye className="h-4 w-4 mr-1" />
                      View
                    </button>
                    {payment.status === 'pending' && (
                      <button
                        onClick={() => handlePayNow(payment.id)}
                        className="btn btn-primary btn-sm"
                      >
                        Pay Now
                      </button>
                    )}
                  </div>
                </div>
              </div>
            ))
          )}
        </div>
      </div>

      {/* Payment Detail Modal */}
      {showPaymentModal && selectedPayment && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6">
            <div className="flex items-center justify-between mb-4">
              <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                Payment Details
              </h3>
              <button
                onClick={() => setShowPaymentModal(false)}
                className="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
              >
                <XCircle className="h-5 w-5" />
              </button>
            </div>
            
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Description
                </label>
                <p className="text-sm text-gray-900 dark:text-white">{selectedPayment.description}</p>
              </div>
              
              {selectedPayment.student_name && (
                <div>
                  <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Student
                  </label>
                  <p className="text-sm text-gray-900 dark:text-white">{selectedPayment.student_name}</p>
                </div>
              )}
              
              <div>
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Amount
                </label>
                <p className="text-lg font-bold text-gray-900 dark:text-white">{formatCurrency(selectedPayment.amount)}</p>
              </div>
              
              <div>
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Due Date
                </label>
                <p className="text-sm text-gray-900 dark:text-white">{formatDate(selectedPayment.due_date)}</p>
              </div>
              
              <div>
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Status
                </label>
                <div>{getPaymentStatusBadge(selectedPayment.status)}</div>
              </div>
              
              {selectedPayment.paid_at && (
                <div>
                  <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Paid Date
                  </label>
                  <p className="text-sm text-gray-900 dark:text-white">{formatDate(selectedPayment.paid_at)}</p>
                </div>
              )}
            </div>
            
            <div className="flex justify-end space-x-3 mt-6">
              <button
                onClick={() => setShowPaymentModal(false)}
                className="btn btn-secondary"
              >
                Close
              </button>
              {selectedPayment.status === 'pending' && (
                <button
                  onClick={() => handlePayNow(selectedPayment.id)}
                  className="btn btn-primary"
                >
                  Pay Now
                </button>
              )}
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default PaymentsPage;